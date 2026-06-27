@include('frontend.navbar')

<!-- Google Fonts -->
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700&family=Playfair+Display:wght@400;700&family=Outfit:wght@300;400;600&display=swap" rel="stylesheet">

<style>
    :root {
        --royal-maroon: #0F1F17;
        --palace-gold: #333333;
        --sandstone: #f4ece2;
        --silk-white: #ffffff;
    }

    body {
        background-color: var(--sandstone);
        background-image:
            radial-gradient(ellipse at top right, rgba(0, 0, 0, 0.12) 0%, transparent 60%),
            radial-gradient(ellipse at bottom left, rgba(90, 25, 25, 0.08) 0%, transparent 50%);
        font-family: 'Outfit', sans-serif;
        color: var(--royal-maroon);
    }

    .mandate-page {
        padding: 80px 20px;
        min-height: 100vh;
    }

    .mandate-container {
        max-width: 800px;
        margin: 0 auto;
        background: #fff;
        border: 1px solid var(--palace-gold);
        box-shadow: 0 40px 80px rgba(61, 10, 10, 0.15);
        position: relative;
    }

    .mandate-container::before {
        content: '';
        position: absolute;
        inset: 10px;
        border: 1px dashed rgba(197, 160, 89, 0.3);
        pointer-events: none;
    }

    .mandate-header {
        background: var(--royal-maroon);
        color: #fff;
        padding: 60px 40px;
        text-align: center;
        border-bottom: 5px double var(--palace-gold);
    }

    .mandate-header h1 {
        font-family: 'Inter', serif;
        font-size: 2rem;
        letter-spacing: 4px;
        margin-bottom: 10px;
        color: var(--palace-gold);
    }

    .mandate-header p {
        font-size: 0.9rem;
        opacity: 0.8;
        letter-spacing: 1px;
    }

    .mandate-body {
        padding: 60px;
    }

    .valuation-box {
        text-align: center;
        margin-bottom: 50px;
        padding-bottom: 30px;
        border-bottom: 1px solid var(--sandstone);
    }

    .valuation-label {
        font-size: 0.8rem;
        text-transform: uppercase;
        letter-spacing: 2px;
        color: var(--palace-gold);
        margin-bottom: 10px;
    }

    .valuation-amount {
        font-family: 'Inter', serif;
        font-size: 3rem;
        font-weight: 700;
    }

    .instruction-step {
        display: flex;
        gap: 25px;
        margin-bottom: 40px;
    }

    .step-number {
        width: 40px;
        height: 40px;
        background: var(--royal-maroon);
        color: var(--palace-gold);
        display: flex;
        align-items: center;
        justify-content: center;
        font-family: 'Inter', serif;
        font-weight: 700;
        border-radius: 50%;
        flex-shrink: 0;
        border: 1px solid var(--palace-gold);
    }

    .step-content h3 {
        font-family: 'Inter', serif;
        font-size: 1.3rem;
        margin-bottom: 10px;
    }

    .bank-card {
        background: var(--sandstone);
        padding: 30px;
        border-radius: 8px;
        margin-top: 15px;
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 25px;
    }

    .bank-item label {
        font-size: 0.7rem;
        text-transform: uppercase;
        color: var(--palace-gold);
        display: block;
        margin-bottom: 5px;
        font-weight: 700;
    }

    .bank-item span {
        font-weight: 600;
        font-size: 1rem;
        color: var(--royal-maroon);
    }

    .copy-hint {
        font-size: 0.7rem;
        color: var(--palace-gold);
        margin-top: 10px;
        display: block;
        font-style: italic;
    }

    .mandate-footer {
        padding: 40px 60px;
        background: var(--sandstone);
        text-align: center;
        border-top: 1px solid rgba(197, 160, 89, 0.2);
    }

    .btn-action {
        display: inline-block;
        padding: 18px 40px;
        background: var(--royal-maroon);
        color: #fff;
        text-decoration: none;
        font-family: 'Inter', serif;
        font-weight: 700;
        letter-spacing: 2px;
        font-size: 0.85rem;
        transition: all 0.3s;
        border: none;
    }

    .btn-action:hover {
        background: var(--palace-gold);
        transform: translateY(-3px);
        box-shadow: 0 10px 20px rgba(61, 10, 10, 0.2);
    }

    .warning-box {
        margin-top: 30px;
        padding: 20px;
        border: 1px solid rgba(197, 160, 89, 0.5);
        background: #fff;
        font-size: 0.85rem;
        line-height: 1.6;
    }

    @media (max-width: 768px) {
        .mandate-body { padding: 30px; }
        .bank-card { grid-template-columns: 1fr; }
        .valuation-amount { font-size: 2.2rem; }
    }
</style>

<main class="mandate-page">
    <div class="mandate-container">
        <div class="mandate-header">
            <h1>Bank Transfer Mandate</h1>
            <p>Order Reference: {{ $order->order_number }}</p>
        </div>

        <div class="mandate-body">
            <div class="valuation-box">
                <div class="valuation-label">Acquisition Valuation</div>
                <div class="valuation-amount">${{ number_format($order->total_amount) }}</div>
            </div>

            <div class="instruction-step">
                <div class="step-number">01</div>
                <div class="step-content">
                    <h3>Initiate Transfer</h3>
                    <p>Please initiate an RTGS, NEFT, or IMPS transfer using the following official treasury details.</p>
                    
                    <div class="bank-card">
                        <div class="bank-item">
                            <label>Beneficiary Name</label>
                            <span>LEXORIA DIAMOND PRIVATE LIMITED</span>
                        </div>
                        <div class="bank-item">
                            <label>Bank Name</label>
                            <span>HDFC BANK</span>
                        </div>
                        <div class="bank-item">
                            <label>Account Number</label>
                            <span style="letter-spacing: 1px;">50200012345678</span>
                        </div>
                        <div class="bank-item">
                            <label>IFSC Code</label>
                            <span style="letter-spacing: 1px;">HDFC0001234</span>
                        </div>
                        <div class="bank-item" style="grid-column: span 2;">
                            <label>Account Type</label>
                            <span>CURRENT ACCOUNT</span>
                        </div>
                    </div>
                    <span class="copy-hint">* Ensure the beneficiary name is entered exactly as shown.</span>
                </div>
            </div>

            <div class="instruction-step">
                <div class="step-number">02</div>
                <div class="step-content">
                    <h3>Include Reference</h3>
                    <p>In the transfer remarks or description field, please strictly include your Order Reference: <strong>{{ $order->order_number }}</strong></p>
                </div>
            </div>

            <div class="instruction-step">
                <div class="step-number">03</div>
                <div class="step-content">
                    <h3>Await Verification</h3>
                    <p>Our treasury team will verify the transfer within 2-4 business hours. Once confirmed, your royal acquisition will proceed to the dispatch phase.</p>
                </div>
            </div>

            <div class="warning-box">
                <i class="bi bi-shield-check me-2 text-gold"></i>
                <strong>Security Notice:</strong> Lexoria Diamond will never ask you for your OTP or PIN. Please only transfer to the official account listed above.
            </div>
        </div>

        <div class="mandate-footer">
            <div class="d-flex gap-3 justify-content-center">
                <a href="{{ route('order.invoice', $order->order_number) }}" target="_blank" class="btn-action" style="background: transparent; color: var(--royal-maroon); border: 1px solid var(--royal-maroon);">Download Royal Receipt</a>
                <a href="{{ route('collections') }}" class="btn-action">Return to Palace</a>
            </div>
            <p style="margin-top: 20px; font-size: 0.8rem; opacity: 0.6;">A copy of these instructions has been sent to your email.</p>
        </div>
    </div>
</main>

@include('frontend.footer')


