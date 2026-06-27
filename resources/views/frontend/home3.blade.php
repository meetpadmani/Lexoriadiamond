<!-- Animated Wedding Marquee Section -->
<link href="https://fonts.googleapis.com/css2?family=Great+Vibes&family=Playfair+Display:ital,wght@0,400;0,500;0,600;1,400;1,500&family=Inter:wght@300;400;500&display=swap" rel="stylesheet">

<section class="luxury-marquee-section">
    <div class="marquee-header-container">
        <span class="marquee-subtitle">Discover The Brilliance</span>
        <h2 class="marquee-title">What other brides are looking for</h2>
        <div class="marquee-divider"></div>
    </div>

    <div class="marquee-wrapper">
        <!-- Row 1 -->
        <div class="marquee-track track-left">
            @for($i=0; $i<4; $i++)
            <div class="marquee-items">
                <span class="text-serif-italic">Bridal Sets</span>
                <span class="star-separator">✦</span>
                <span class="text-sans-tracked">DIAMOND NECKLACES</span>
                <span class="star-separator">✦</span>
                <span class="text-script-gold">Timeless Elegance</span>
                <span class="star-separator">✦</span>
                <span class="text-serif-italic">Engagement Rings</span>
                <span class="star-separator">✦</span>
                <span class="text-sans-tracked">SOLITAIRES</span>
                <span class="star-separator">✦</span>
            </div>
            @endfor
        </div>
        
        <!-- Row 2 -->
        <div class="marquee-track track-right">
            @for($i=0; $i<4; $i++)
            <div class="marquee-items">
                <span class="text-script-gold">Royal Heritage</span>
                <span class="star-separator">✦</span>
                <span class="text-sans-tracked">POLKI & KUNDAN</span>
                <span class="star-separator">✦</span>
                <span class="text-serif-italic">Luxury Bangles</span>
                <span class="star-separator">✦</span>
                <span class="text-script-gold">Master Craftsmanship</span>
                <span class="star-separator">✦</span>
                <span class="text-sans-tracked">EARRINGS</span>
                <span class="star-separator">✦</span>
            </div>
            @endfor
        </div>
    </div>
</section>

<style>
    .luxury-marquee-section {
        background-color: #FAFAF7; /* Very premium light ivory/stone */
        padding: 100px 0;
        position: relative;
        overflow: hidden;
        border-top: 1px solid rgba(201, 169, 110, 0.2);
        border-bottom: 1px solid rgba(201, 169, 110, 0.2);
    }

    .marquee-header-container {
        text-align: center;
        margin-bottom: 80px;
        position: relative;
        z-index: 10;
    }

    .marquee-subtitle {
        font-family: 'Inter', sans-serif;
        font-size: 0.75rem;
        text-transform: uppercase;
        letter-spacing: 4px;
        color: #C9A96E;
        display: block;
        margin-bottom: 15px;
    }

    .marquee-title {
        font-family: 'Playfair Display', serif;
        font-size: 2.8rem;
        color: #111111;
        font-weight: 400;
        margin: 0;
        letter-spacing: 1px;
    }

    .marquee-divider {
        width: 60px;
        height: 1px;
        background-color: #C9A96E;
        margin: 30px auto 0;
    }

    .marquee-wrapper {
        position: relative;
        width: 100%;
        transform: rotate(-2deg) scale(1.05); /* Slight tilt for modern editorial feel */
        margin-top: 30px;
        background: #ffffff;
        padding: 20px 0;
        box-shadow: 0 20px 40px rgba(0,0,0,0.03);
        border-top: 1px solid rgba(0,0,0,0.05);
        border-bottom: 1px solid rgba(0,0,0,0.05);
    }

    /* Edge gradients for smooth fade */
    .marquee-wrapper::before,
    .marquee-wrapper::after {
        content: '';
        position: absolute;
        top: 0;
        width: 15%;
        height: 100%;
        z-index: 2;
        pointer-events: none;
    }
    .marquee-wrapper::before {
        left: 0;
        background: linear-gradient(to right, #ffffff, transparent);
    }
    .marquee-wrapper::after {
        right: 0;
        background: linear-gradient(to left, #ffffff, transparent);
    }

    .marquee-track {
        display: flex;
        width: max-content;
        margin-bottom: 20px;
    }

    .marquee-track:last-child {
        margin-bottom: 0;
    }

    .marquee-items {
        display: flex;
        align-items: center;
        padding-right: 40px;
    }

    .track-left {
        animation: scroll-left-lux 35s linear infinite;
    }

    .track-right {
        animation: scroll-right-lux 40s linear infinite;
        transform: translateX(-50%);
    }

    @keyframes scroll-left-lux {
        0% { transform: translateX(0); }
        100% { transform: translateX(-50%); } 
    }

    @keyframes scroll-right-lux {
        0% { transform: translateX(-50%); }
        100% { transform: translateX(0); }
    }

    /* Typography Classes */
    .text-serif-italic {
        font-family: 'Playfair Display', serif;
        font-size: 2.2rem;
        font-weight: 400;
        font-style: italic;
        color: #111111;
        padding: 0 30px;
        white-space: nowrap;
    }

    .text-sans-tracked {
        font-family: 'Inter', sans-serif;
        font-size: 0.8rem;
        font-weight: 500;
        letter-spacing: 6px;
        text-transform: uppercase;
        color: #555555;
        padding: 0 30px;
        white-space: nowrap;
    }

    .text-script-gold {
        font-family: 'Great Vibes', cursive;
        font-size: 3rem;
        color: #C9A96E;
        padding: 0 30px;
        line-height: 1;
        transform: translateY(-5px); 
        white-space: nowrap;
    }

    .star-separator {
        color: #C9A96E;
        font-size: 1.2rem;
        opacity: 0.5;
    }

    /* Hover pause */
    .marquee-wrapper:hover .marquee-track {
        animation-play-state: paused;
    }

    /* Mobile */
    @media (max-width: 768px) {
        .luxury-marquee-section { padding: 60px 0; }
        .marquee-title { font-size: 2rem; }
        .marquee-wrapper { transform: rotate(0) scale(1); padding: 30px 0; }
        .text-serif-italic { font-size: 1.6rem; padding: 0 15px; }
        .text-sans-tracked { font-size: 0.7rem; padding: 0 15px; }
        .text-script-gold { font-size: 2rem; padding: 0 15px; }
        .marquee-items { padding-right: 20px; }
        .marquee-track { margin-bottom: 15px; }
    }
</style>
