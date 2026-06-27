const pptxgen = require('pptxgenjs');

let pptx = new pptxgen();

pptx.layout = 'LAYOUT_16x9';

const images = [
    'C:\\Users\\HELLO\\.gemini\\antigravity-ide\\brain\\2b1e9cab-f6de-4843-8060-562a756640e3\\media__1781934823994.png',
    'C:\\Users\\HELLO\\.gemini\\antigravity-ide\\brain\\2b1e9cab-f6de-4843-8060-562a756640e3\\media__1781934999521.png',
    'C:\\Users\\HELLO\\.gemini\\antigravity-ide\\brain\\2b1e9cab-f6de-4843-8060-562a756640e3\\media__1781935126722.png',
    'C:\\Users\\HELLO\\.gemini\\antigravity-ide\\brain\\2b1e9cab-f6de-4843-8060-562a756640e3\\media__1781935361708.png',
    'C:\\Users\\HELLO\\.gemini\\antigravity-ide\\brain\\2b1e9cab-f6de-4843-8060-562a756640e3\\media__1781935544536.png',
    'C:\\Users\\HELLO\\.gemini\\antigravity-ide\\brain\\2b1e9cab-f6de-4843-8060-562a756640e3\\media__1781935731614.png'
];

// Helper to add title and bullets
function addTextSlide(title, bullets) {
    let slide = pptx.addSlide();
    slide.addText(title, { x: 0.5, y: 0.5, w: 9, h: 1, fontSize: 36, bold: true, color: '111111' });
    
    let bulletOptions = { x: 0.5, y: 1.8, w: 9, h: 3, fontSize: 24, color: '333333', bullet: true, lineSpacing: 35 };
    let textBody = bullets.map(b => ({ text: b }));
    slide.addText(textBody, bulletOptions);
}

function addImageSlide(title, imgPath) {
    let slide = pptx.addSlide();
    slide.addText(title, { x: 0.5, y: 0.3, w: 9, h: 0.8, fontSize: 32, bold: true, color: '111111' });
    slide.addImage({ path: imgPath, x: 1, y: 1.2, w: 8, h: 4.5, sizing: { type: 'contain', w: 8, h: 4.5 } });
}

// Slide 1: Title
let slide1 = pptx.addSlide();
slide1.addText('LEXORIA DIAMOND', { x: 0, y: 2, w: 10, h: 1.5, fontSize: 54, bold: true, color: 'C9A96E', align: 'center' });
slide1.addText('Premium E-Commerce Platform Presentation', { x: 0, y: 3.5, w: 10, h: 1, fontSize: 24, color: '555555', align: 'center' });

// Slide 2: Project Overview
addTextSlide('Project Overview', [
    'Complete digital transformation for a luxury diamond brand.',
    'Developed a robust, high-performance E-commerce platform.',
    'Focused on premium aesthetics, seamless UX, and conversion.',
    'Dual support for physical jewelry and digital asset sales.',
    'Built entirely from scratch utilizing modern web technologies.'
]);

// Slide 3: Vision & Target Audience
addTextSlide('Vision & Target Audience', [
    'Vision: To provide a Vogue-like, premium shopping experience.',
    'Audience: High net-worth individuals & luxury shoppers.',
    'Market Focus: United States (USD Pricing & tailored shipping).',
    'Goal: Build trust through absolute transparency and elegant design.'
]);

// Slide 4: Key Features Implemented
addTextSlide('Key Features Implemented', [
    'Dynamic Homepage with high-end marquee and video headers.',
    'Cinematic & Standard Product Detail Page variants.',
    'WhatsApp Instant Purchase integration for digital items.',
    'Automated cart and robust checkout flow.',
    'Interactive 360-degree gallery and review system.'
]);

// Slide 5: Frontend Architecture
addTextSlide('Frontend Architecture', [
    'Utilized Laravel Blade for dynamic server-side rendering.',
    'Custom CSS for glassmorphism and premium micro-interactions.',
    'Vanilla JavaScript for lightweight, fast DOM manipulation.',
    'Fully responsive layout prioritizing "Mobile-First" principles.',
    'Zero heavy CSS frameworks (no Bootstrap/Tailwind) for custom look.'
]);

// Slide 6: Home Page UI & UX
addTextSlide('Home Page UI & UX', [
    'Hero Section: Immersive video backgrounds to capture attention.',
    'Marquee: Premium tilted editorial text with elegant typography.',
    'Featured Categories: High-resolution grid showcasing collections.',
    'Color Palette: Ivory backgrounds, Deep darks, and Soft Gold.',
    'Typography: Playfair Display and Inter for luxury contrast.'
]);

// Slide 7: Screenshot (Home/Hero)
addImageSlide('Platform Interface Showcase (1)', images[0]);

// Slide 8: Product Catalog & Filtering
addTextSlide('Product Catalog & Filtering', [
    'Clean grid layout showcasing multiple products at once.',
    'Hover interactions to reveal secondary angles of jewelry.',
    'Quick Add-to-Cart and Wishlist functionality on the grid.',
    'Price and SKU display without cluttering the interface.',
    'Real-time sorting and filtering by metal type and price.'
]);

// Slide 9: Screenshot
addImageSlide('Platform Interface Showcase (2)', images[1]);

// Slide 10: Dynamic Product Details
addTextSlide('Dynamic Product Details', [
    'Two layouts tested: Cinematic Split-Screen and Standard.',
    'Digital vs Physical logic dynamically alters the UI.',
    'Physical: Shows delivery estimates, making charges, and taxes.',
    'Digital: Shows WhatsApp instant purchase and removes GST.',
    'Sticky image gallery for uninterrupted browsing.'
]);

// Slide 11: Screenshot
addImageSlide('Platform Interface Showcase (3)', images[2]);

// Slide 12: Trust & Conversion Optimization
addTextSlide('Trust & Conversion Optimization', [
    'Prominent display of Trust Badges (GIA Certified, Conflict-Free).',
    'Explicit mentions of the Kimberley Process and ethical sourcing.',
    '"Secure & Encrypted Checkout" banners with payment icons.',
    'Customer Review integration with 5-star rating system.',
    'Transparent pricing breakdown (Metal, Making Charges, etc.).'
]);

// Slide 13: Screenshot
addImageSlide('Platform Interface Showcase (4)', images[3]);

// Slide 14: Mobile Responsiveness
addTextSlide('Mobile Responsiveness', [
    'Native App Feel: Pull-up drawer effects on mobile product pages.',
    'Floating Action Bar (FAB): "Add to Cart" always within thumb reach.',
    'Touch-friendly image carousels and easy-to-tap buttons.',
    'Optimized font scaling for readability on small screens.',
    'Collapsible mobile navigation menus.'
]);

// Slide 15: Screenshot
addImageSlide('Platform Interface Showcase (5)', images[4]);

// Slide 16: WhatsApp Integration (Unique Feature)
addTextSlide('WhatsApp Integration (Unique Feature)', [
    'Directly routes digital product buyers to a WhatsApp chat.',
    'Pre-fills the message with the exact product URL and details.',
    'Bypasses the traditional cart for instant, high-touch conversions.',
    'Styled explicitly in WhatsApp Green to draw attention.',
    'Seamlessly bridges website traffic with direct sales team.'
]);

// Slide 17: Performance & Loading Optimization
addTextSlide('Performance & Loading Optimization', [
    'Custom CSS results in minimal file size payloads.',
    'Images are lazily loaded to ensure immediate first paint.',
    'AJAX forms used for Add to Cart without page refreshes.',
    'Custom luxury loading screen with SVG diamond drawing animation.',
    'Smooth state transitions using hardware-accelerated CSS.'
]);

// Slide 18: Security & Backend Integrations
addTextSlide('Security & Backend Integrations', [
    'CSRF Protection implemented on all forms.',
    'Session-based cart management ensuring data integrity.',
    'Dynamic route handling matching SEO-friendly slugs.',
    'Secure Checkout with SSL and encrypted token transfers.',
    'Admin panel integration for real-time product updates.'
]);

// Slide 19: Future Roadmap
addTextSlide('Future Roadmap', [
    'AR (Augmented Reality) "Try at Home" utilizing device cameras.',
    'Multi-currency support targeting Europe and Middle East.',
    'AI-powered ring sizing and jewelry recommendations.',
    'Automated Instagram Shop API integrations.',
    'Expanded customer loyalty and referral programs.'
]);

// Slide 20: Thank You
let slide20 = pptx.addSlide();
slide20.addText('Thank You', { x: 0, y: 2, w: 10, h: 1.5, fontSize: 64, bold: true, color: 'C9A96E', align: 'center' });
slide20.addText('Ready for Deployment & Launch.', { x: 0, y: 3.5, w: 10, h: 1, fontSize: 24, color: '555555', align: 'center' });

pptx.writeFile({ fileName: 'D:\\LEXORIA DIAMOND\\Lexoria_Presentation.pptx' }).then(fileName => {
    console.log('created: ' + fileName);
});
