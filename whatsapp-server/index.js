const express = require('express');
const { Client, LocalAuth, MessageMedia } = require('whatsapp-web.js');
const qrcode = require('qrcode');
const cors = require('cors');

const app = express();
const port = 3000;

app.use(cors());
app.use(express.json());

let currentQR = null;
let clientStatus = 'INITIALIZING';
let stats = { sent: 0, failed: 0 };

let client;

function initializeClient() {
    client = new Client({
        authStrategy: new LocalAuth(),
        puppeteer: {
            args: ['--no-sandbox', '--disable-setuid-sandbox', '--disable-dev-shm-usage', '--disable-accelerated-2d-canvas', '--no-first-run', '--no-zygote', '--single-process', '--disable-gpu'],
            headless: true
        }
    });

    client.on('qr', (qr) => {
        clientStatus = 'QR_READY';
        currentQR = qr;
        console.log('QR RECEIVED');
    });

    client.on('ready', () => {
        clientStatus = 'READY';
        currentQR = null;
        console.log('Client is ready!');
    });

    client.on('authenticated', () => {
        clientStatus = 'AUTHENTICATED';
        console.log('Client is authenticated!');
    });

    client.on('auth_failure', msg => {
        clientStatus = 'AUTH_FAILED';
        console.error('AUTHENTICATION FAILURE', msg);
    });

    client.on('disconnected', (reason) => {
        clientStatus = 'DISCONNECTED';
        console.log('Client was disconnected', reason);
        setTimeout(initializeClient, 5000); // Reinitialize after 5 seconds
    });

    client.initialize().catch(err => {
        console.error('Failed to initialize client:', err);
        clientStatus = 'INITIALIZING';
        setTimeout(initializeClient, 5000); // Retry after 5 seconds
    });
}

initializeClient();

// API Endpoints
app.get('/api/status', (req, res) => {
    res.json({ status: clientStatus, stats: stats });
});

app.get('/api/qr', async (req, res) => {
    console.log('GET /api/qr called, clientStatus:', clientStatus);
    if (clientStatus === 'READY' || clientStatus === 'AUTHENTICATED') {
        return res.json({ success: true, message: 'Already authenticated', qr: null });
    }
    
    if (currentQR) {
        try {
            console.log('Generating QR code data URL...');
            const qrDataUrl = await qrcode.toDataURL(currentQR);
            console.log('QR code generated successfully');
            return res.json({ success: true, qr: qrDataUrl });
        } catch (err) {
            console.error('QR generation failed:', err);
            return res.status(500).json({ success: false, error: 'Failed to generate QR code' });
        }
    }
    
    console.log('QR not ready, currentQR is null');
    res.json({ success: false, message: 'QR not ready yet or already authenticated' });
});

app.post('/api/send', async (req, res) => {
    if (clientStatus !== 'READY' && clientStatus !== 'AUTHENTICATED') {
        return res.status(503).json({ success: false, error: 'WhatsApp client is not ready or authenticated' });
    }

    const { phone, message, mediaUrl } = req.body;
    
    if (!phone || !message) {
        return res.status(400).json({ success: false, error: 'Phone and message are required' });
    }

    // Format phone number: remove non-digits, ensure country code
    let formattedPhone = phone.replace(/\D/g, '');
    
    // Add WhatsApp domain suffix
    if (!formattedPhone.endsWith('@c.us')) {
        formattedPhone = `${formattedPhone}@c.us`;
    }

    try {
        const numberId = await client.getNumberId(formattedPhone);
        if (!numberId) {
            return res.status(400).json({ success: false, error: 'Phone number is not registered on WhatsApp' });
        }

        let response;
        if (mediaUrl) {
            try {
                const media = await MessageMedia.fromUrl(mediaUrl, { unsafeMime: true });
                response = await client.sendMessage(numberId._serialized, media, { caption: message });
            } catch (mediaErr) {
                console.error('Failed to load media, sending text instead:', mediaErr);
                response = await client.sendMessage(numberId._serialized, message);
            }
        } else {
            response = await client.sendMessage(numberId._serialized, message);
        }

        stats.sent++;
        res.json({ success: true, response });
    } catch (err) {
        console.error('Failed to send message:', err);
        stats.failed++;
        res.status(500).json({ success: false, error: err.message });
    }
});

app.listen(port, () => {
    console.log(`WhatsApp service listening at http://localhost:${port}`);
});
