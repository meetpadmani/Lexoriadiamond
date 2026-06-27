@include('frontend.pages._layout')

<style>
    @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,600;1,400&family=Great+Vibes&display=swap');
    
    /* About Page Styles */
    .frames-hero-container {
        position: relative;
        width: 100%;
        height: 600vh; /* Scroll length increased for zoom and info */
        background: #000;
    }
    
    .founder-info {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        color: #fff;
        text-align: center;
        z-index: 20;
        pointer-events: none;
        opacity: 0;
        width: 90%;
        max-width: 900px;
        padding: 70px 50px;
        background: linear-gradient(135deg, rgba(20, 15, 10, 0.8), rgba(5, 5, 5, 0.9));
        backdrop-filter: blur(16px);
        -webkit-backdrop-filter: blur(16px);
        border: 1px solid rgba(201, 169, 110, 0.4);
        border-radius: 8px;
        box-shadow: 0 40px 80px rgba(0, 0, 0, 0.8), inset 0 0 30px rgba(201, 169, 110, 0.15);
    }
    
    .founder-info::before {
        content: '';
        position: absolute;
        top: 15px; bottom: 15px; left: 15px; right: 15px;
        border: 1px solid rgba(201, 169, 110, 0.2);
        border-radius: 4px;
        pointer-events: none;
    }

    .founder-info::after {
        content: '';
        position: absolute;
        top: 25px; bottom: 25px; left: 25px; right: 25px;
        border: 1px dashed rgba(201, 169, 110, 0.1);
        border-radius: 2px;
        pointer-events: none;
    }
    
    .founder-info h3 {
        font-family: var(--font-heading, serif);
        font-size: 1.1rem;
        color: var(--brand-gold, #c9a96e);
        margin-bottom: 20px;
        letter-spacing: 8px;
        text-transform: uppercase;
        position: relative;
        display: inline-block;
    }
    
    .founder-info h3::after {
        content: '';
        display: block;
        width: 60px;
        height: 2px;
        background: var(--brand-gold, #c9a96e);
        margin: 15px auto 0;
    }
    
    .founder-info h1 {
        font-family: 'Playfair Display', serif;
        font-size: clamp(3.5rem, 7vw, 6rem);
        margin-bottom: 25px;
        font-weight: 400;
        letter-spacing: 2px;
        text-shadow: 0 10px 30px rgba(0,0,0,0.8);
        background: linear-gradient(to bottom right, #ffffff 20%, #e8c97a 80%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    .founder-bio {
        font-family: 'Playfair Display', serif;
        font-size: 1.25rem;
        font-style: italic;
        line-height: 1.9;
        color: rgba(255, 255, 255, 0.9);
        max-width: 700px;
        margin: 0 auto 35px;
        font-weight: 400;
        letter-spacing: 0.5px;
    }
    
    .founder-signature {
        font-family: 'Great Vibes', cursive;
        font-size: 4rem;
        color: var(--brand-gold, #c9a96e);
        margin-top: 10px;
        font-style: normal;
        transform: rotate(-4deg);
        text-shadow: 0 5px 15px rgba(0,0,0,0.5);
    }
    
    .frames-hero-sticky {
        position: sticky;
        top: 0;
        left: 0;
        width: 100%;
        height: 100vh;
        overflow: hidden;
    }
    
    #framesCanvas {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        max-width: 100%;
        max-height: 100vh;
        object-fit: contain;
    }
    


    .premium-dark-section {
        background: #050505;
        color: #fff;
        padding: 120px 20px;
        border-top: 1px solid rgba(201, 169, 110, 0.1);
        position: relative;
        overflow: hidden;
    }
    
    .premium-dark-section::before {
        content: '';
        position: absolute;
        top: 0; left: 0; width: 100%; height: 100%;
        background: radial-gradient(circle at center, rgba(201, 169, 110, 0.05) 0%, transparent 70%);
        pointer-events: none;
    }

    .about-container {
        max-width: 1200px;
        margin: 0 auto;
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 80px;
        align-items: center;
        position: relative;
        z-index: 1;
    }

    .about-container.inverse {
        direction: rtl;
    }
    .about-container.inverse > * {
        direction: ltr;
    }

    .about-text {
        transform-style: preserve-3d;
        padding: 50px;
        background: rgba(15, 15, 15, 0.6);
        backdrop-filter: blur(10px);
        -webkit-backdrop-filter: blur(10px);
        border: 1px solid rgba(201, 169, 110, 0.2);
        border-radius: 8px;
        box-shadow: 0 30px 60px rgba(0,0,0,0.5);
    }

    .about-text h2 {
        font-family: 'Playfair Display', serif;
        font-size: 3.5rem;
        margin-bottom: 30px;
        background: linear-gradient(to right, #fff, #c9a96e);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        line-height: 1.2;
    }

    .about-text p {
        font-family: 'Playfair Display', serif;
        font-size: 1.2rem;
        line-height: 1.9;
        margin-bottom: 25px;
        color: rgba(255, 255, 255, 0.85);
        font-weight: 300;
    }

    .about-image-3d {
        transform-style: preserve-3d;
        position: relative;
        border-radius: 12px;
        border: 1px solid rgba(201, 169, 110, 0.3);
        box-shadow: 0 40px 80px rgba(0,0,0,0.8);
        background: #000;
    }

    .about-image-3d img {
        width: 100%;
        height: auto;
        display: block;
        border-radius: 12px;
        opacity: 0.85;
    }

    .tilt-inner {
        transform: translateZ(50px);
    }
    
    .features-grid {
        max-width: 1200px;
        margin: 0 auto;
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 40px;
        text-align: center;
        position: relative;
        z-index: 1;
    }

    .feature-card-3d {
        transform-style: preserve-3d;
        padding: 50px 30px;
        background: rgba(15, 15, 15, 0.8);
        border: 1px solid rgba(201, 169, 110, 0.2);
        border-radius: 10px;
        transition: border-color 0.3s ease;
        box-shadow: 0 20px 40px rgba(0,0,0,0.5);
    }
    
    .feature-card-3d:hover {
        border-color: rgba(201, 169, 110, 0.6);
    }
    
    .feature-card-3d h3 {
        font-family: 'Playfair Display', serif;
        font-size: 1.8rem;
        color: #fff;
        margin-bottom: 15px;
    }
    
    .feature-card-3d p {
        color: rgba(255, 255, 255, 0.7);
        line-height: 1.8;
    }

    .feature-icon {
        font-size: 3rem;
        color: var(--brand-gold, #c9a96e);
        margin-bottom: 25px;
    }

    /* 3D Diamond Scene */
    .diamond-scene {
        width: 300px;
        height: 300px;
        perspective: 1000px;
        margin: 0 auto;
        position: relative;
        z-index: 10;
    }
    .diamond-3d {
        width: 100%;
        height: 100%;
        position: relative;
        transform-style: preserve-3d;
        animation: spin-diamond 10s infinite linear;
        cursor: grab;
    }
    .face {
        position: absolute;
        width: 0;
        height: 0;
        left: 50%;
        top: 50%;
        border-style: solid;
        border-width: 0 100px 150px 100px;
        transform-origin: center top;
        opacity: 0.9;
    }
    
    /* Top faces (points up) */
    .face.top {
        border-color: transparent transparent rgba(201, 169, 110, 0.4) transparent;
        border-width: 0 100px 120px 100px;
        margin-left: -100px;
        margin-top: -60px;
    }
    .face.top.front { transform: rotateY(0deg) translateZ(100px) rotateX(35deg); border-bottom-color: rgba(255, 255, 255, 0.8); }
    .face.top.right { transform: rotateY(90deg) translateZ(100px) rotateX(35deg); border-bottom-color: rgba(201, 169, 110, 0.6); }
    .face.top.back  { transform: rotateY(180deg) translateZ(100px) rotateX(35deg); border-bottom-color: rgba(255, 255, 255, 0.5); }
    .face.top.left  { transform: rotateY(-90deg) translateZ(100px) rotateX(35deg); border-bottom-color: rgba(201, 169, 110, 0.7); }

    /* Bottom faces (points down) */
    .face.bottom {
        border-color: rgba(201, 169, 110, 0.6) transparent transparent transparent;
        border-width: 180px 100px 0 100px;
        margin-left: -100px;
        margin-top: -60px;
        transform-origin: center top;
    }
    .face.bottom.front { transform: rotateY(0deg) translateZ(100px) rotateX(-40deg); border-top-color: rgba(201, 169, 110, 0.9); }
    .face.bottom.right { transform: rotateY(90deg) translateZ(100px) rotateX(-40deg); border-top-color: rgba(255, 255, 255, 0.6); }
    .face.bottom.back  { transform: rotateY(180deg) translateZ(100px) rotateX(-40deg); border-top-color: rgba(201, 169, 110, 0.8); }
    .face.bottom.left  { transform: rotateY(-90deg) translateZ(100px) rotateX(-40deg); border-top-color: rgba(255, 255, 255, 0.7); }

    @keyframes spin-diamond {
        from { transform: rotateY(0deg) rotateX(-10deg); }
        to { transform: rotateY(360deg) rotateX(-10deg); }
    }

    @media (max-width: 992px) {
        .about-container {
            grid-template-columns: 1fr;
            direction: ltr !important;
        }
        .about-text h2 {
            font-size: 2.5rem;
        }
    }
</style>

<div class="frames-hero-container" id="framesContainer">
    <div class="frames-hero-sticky">
        <canvas id="framesCanvas"></canvas>
        <div class="founder-info" id="founderInfo">
            <h3>Founder & Visionary</h3>
            <h1>Meet Padmani</h1>
            <p class="founder-bio">"Our legacy is built on an unwavering commitment to perfection. Every diamond we select, every design we craft, is a testament to our passion for bringing the earth's most brilliant treasures to life."</p>
            <div class="founder-signature">Meet Padmani</div>
        </div>
        <div id="scrollIndicator" style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); text-align: center; color: rgba(255,255,255,0.9); font-family: 'Playfair Display', serif; font-size: 2rem; letter-spacing: 2px; z-index: 100; font-style: italic;">
            Scroll to Discover<br>
            <i class="bi bi-chevron-down" style="font-size: 3.5rem; color: var(--brand-gold, #c9a96e); display: block; margin-top: 15px; animation: bounce 2s infinite;"></i>
        </div>
        <style>
            @keyframes bounce {
                0%, 20%, 50%, 80%, 100% { transform: translateY(0); }
                40% { transform: translateY(-15px); }
                60% { transform: translateY(-7px); }
            }
        </style>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/ScrollTrigger.min.js"></script>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        if (typeof gsap === 'undefined') return;
        gsap.registerPlugin(ScrollTrigger);

        const canvas = document.getElementById("framesCanvas");
        const context = canvas.getContext("2d");

        // Set high-res canvas size
        canvas.width = 1920;
        canvas.height = 1080;

        const frameCount = 50;
        
        // Define the image source generator
        const currentFrame = index => {
            return `/freams/ezgif-frame-${(index + 1).toString().padStart(3, '0')}.jpg`;
        };

        const images = [];
        const frames = { frame: 0 };

        // Preload images
        for (let i = 0; i < frameCount; i++) {
            const img = new Image();
            img.src = currentFrame(i);
            images.push(img);
        }

        // Render first frame as soon as it loads
        images[0].onload = render;

        function render() {
            if(images[frames.frame] && images[frames.frame].complete) {
                // To maintain aspect ratio and fill canvas (like object-fit: cover)
                const img = images[frames.frame];
                const canvasAspect = canvas.width / canvas.height;
                const imgAspect = img.width / img.height;
                let drawWidth = canvas.width;
                let drawHeight = canvas.height;
                let offsetX = 0;
                let offsetY = 0;

                if (imgAspect > canvasAspect) {
                    drawWidth = img.width * (canvas.height / img.height);
                    offsetX = (canvas.width - drawWidth) / 2;
                } else {
                    drawHeight = img.height * (canvas.width / img.width);
                    offsetY = (canvas.height - drawHeight) / 2;
                }

                context.clearRect(0, 0, canvas.width, canvas.height);
                context.drawImage(img, offsetX, offsetY, drawWidth, drawHeight);
            }
        }

        // Create the scroll animation timeline
        const tl = gsap.timeline({
            scrollTrigger: {
                trigger: "#framesContainer",
                start: "top top",
                end: "bottom bottom",
                scrub: 0.5,
            }
        });

        // Fade out scroll indicator immediately on scroll
        gsap.to("#scrollIndicator", {
            scrollTrigger: {
                trigger: "#framesContainer",
                start: "top top",
                end: "+=200",
                scrub: true
            },
            opacity: 0,
            y: -20
        });

        // 1. Play frames sequence
        tl.to(frames, {
            frame: frameCount - 1,
            snap: "frame",
            ease: "none",
            onUpdate: render,
            duration: 4
        });

        // 2. Zoom in the canvas image after frames finish
        tl.to(canvas, {
            scale: 2.5,
            opacity: 0.3,
            ease: "power2.inOut",
            duration: 2
        }, "+=0.2");

        // 3. Fade in Founder Info
        tl.fromTo("#founderInfo", {
            opacity: 0,
            scale: 0.8,
            y: 30
        }, {
            opacity: 1,
            scale: 1,
            y: 0,
            ease: "power2.out",
            duration: 1.5
        }, "<0.5");

        // 4. 3D Scroll Animations for the rest of the page content
        gsap.utils.toArray('.about-text').forEach(card => {
            gsap.from(card, {
                scrollTrigger: {
                    trigger: card,
                    start: "top 90%",
                    end: "top 40%",
                    scrub: 1,
                },
                y: 150,
                opacity: 0,
                rotationX: -25,
                transformPerspective: 1200
            });
        });

        gsap.utils.toArray('.about-image-3d').forEach(img => {
            gsap.from(img, {
                scrollTrigger: {
                    trigger: img,
                    start: "top 90%",
                    end: "top 40%",
                    scrub: 1,
                },
                x: img.parentElement.classList.contains('inverse') ? 150 : -150,
                opacity: 0,
                rotationY: img.parentElement.classList.contains('inverse') ? -20 : 20,
                transformPerspective: 1200
            });
        });

        gsap.from('.feature-card-3d', {
            scrollTrigger: {
                trigger: '.features-grid',
                start: "top 85%",
                end: "top 40%",
                scrub: 1,
            },
            y: 150,
            opacity: 0,
            rotationX: -30,
            stagger: 0.2,
            transformPerspective: 1200
        });
    });
</script>

<section class="premium-dark-section">
    <div class="about-container">
        <div class="about-text" data-tilt data-tilt-max="5" data-tilt-glare="true" data-tilt-max-glare="0.1">
            <h2 class="tilt-inner">The Heritage of Brilliance</h2>
            <p class="tilt-inner">Welcome to Lexoria Diamond, where extraordinary craftsmanship meets timeless elegance. For decades, we have dedicated ourselves to the pursuit of perfection, creating masterpieces that celebrate life's most precious moments.</p>
            <p class="tilt-inner">Every piece in our collection tells a story of passion, precision, and unparalleled beauty, forged through techniques passed down through generations of master artisans.</p>
            <div style="margin-top: 40px;" class="tilt-inner">
                <a href="{{ route('our-story') }}" class="btn-royal" style="background: var(--brand-gold, #c9a96e); color: #000; padding: 15px 30px; text-decoration: none; font-weight: bold; text-transform: uppercase; letter-spacing: 2px; border-radius: 4px;">Read Our Full Story</a>
            </div>
        </div>
        <div class="about-image-3d" data-tilt data-tilt-max="10" data-tilt-speed="400" data-tilt-perspective="1000" data-tilt-glare="true" data-tilt-max-glare="0.3">
            <img src="/frontend/images/collection.png" alt="Lexoria Collection" class="tilt-inner">
        </div>
    </div>
</section>

<section class="premium-dark-section">
    <div class="about-container inverse">
        <div class="about-image-3d" data-tilt data-tilt-max="10" data-tilt-speed="400" data-tilt-perspective="1000" data-tilt-glare="true" data-tilt-max-glare="0.3">
            <img src="/frontend/images/craftsmanship.png" alt="Master Craftsmanship" class="tilt-inner">
        </div>
        <div class="about-text" data-tilt data-tilt-max="5" data-tilt-glare="true" data-tilt-max-glare="0.1">
            <h2 class="tilt-inner">The Journey of a Diamond</h2>
            <p class="tilt-inner">We source only the finest, ethically-mined diamonds, selecting the top 1% of stones in the world. Each diamond is then entrusted to our master artisans, who spend hundreds of hours hand-polishing and setting them into intricate, bespoke designs.</p>
            <p class="tilt-inner">From rough stone to a radiant masterpiece, our rigorous standards ensure that a Lexoria diamond will burn brightly for generations to come.</p>
        </div>
    </div>
</section>

<section class="premium-dark-section">
    <div class="features-grid">
        <div class="feature-card-3d" data-tilt data-tilt-max="15" data-tilt-speed="400" data-tilt-glare="true" data-tilt-max-glare="0.2" data-tilt-perspective="500">
            <i class="bi bi-gem feature-icon tilt-inner"></i>
            <h3 class="tilt-inner">Certified Brilliance</h3>
            <p class="tilt-inner">Every diamond is certified by leading gemological institutes, ensuring exceptional quality, cut, and clarity.</p>
        </div>
        <div class="feature-card-3d" data-tilt data-tilt-max="15" data-tilt-speed="400" data-tilt-glare="true" data-tilt-max-glare="0.2" data-tilt-perspective="500">
            <i class="bi bi-shield-check feature-icon tilt-inner"></i>
            <h3 class="tilt-inner">Ethical Sourcing</h3>
            <p class="tilt-inner">Deeply committed to conflict-free sourcing, ensuring our diamonds come from responsible and transparent origins.</p>
        </div>
        <div class="feature-card-3d" data-tilt data-tilt-max="15" data-tilt-speed="400" data-tilt-glare="true" data-tilt-max-glare="0.2" data-tilt-perspective="500">
            <i class="bi bi-brush feature-icon tilt-inner"></i>
            <h3 class="tilt-inner">Master Craftsmanship</h3>
            <p class="tilt-inner">Handcrafted by skilled artisans who pour their heart and decades of experience into every exacting detail.</p>
        </div>
    </div>
</section>

<style>
    .carousel-container {
        width: 100%;
        height: 400px;
        perspective: 1500px;
        display: flex;
        justify-content: center;
        align-items: center;
        position: relative;
        z-index: 10;
    }
    .carousel-3d {
        width: 300px;
        height: 400px;
        position: relative;
        transform-style: preserve-3d;
        animation: spin-carousel 20s infinite linear;
    }
    .carousel-3d:hover {
        animation-play-state: paused;
    }
    .carousel-item {
        position: absolute;
        width: 300px;
        height: 400px;
        left: 0;
        top: 0;
        border-radius: 12px;
        overflow: hidden;
        border: 1px solid rgba(201, 169, 110, 0.4);
        box-shadow: 0 20px 50px rgba(0,0,0,0.8), inset 0 0 20px rgba(201,169,110,0.2);
        background: #000;
    }
    .carousel-item img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        opacity: 0.7;
        transition: opacity 0.5s, transform 0.5s;
    }
    .carousel-item:hover img {
        opacity: 1;
        transform: scale(1.05);
    }
    
    .carousel-item:nth-child(1) { transform: rotateY(0deg) translateZ(350px); }
    .carousel-item:nth-child(2) { transform: rotateY(60deg) translateZ(350px); }
    .carousel-item:nth-child(3) { transform: rotateY(120deg) translateZ(350px); }
    .carousel-item:nth-child(4) { transform: rotateY(180deg) translateZ(350px); }
    .carousel-item:nth-child(5) { transform: rotateY(240deg) translateZ(350px); }
    .carousel-item:nth-child(6) { transform: rotateY(300deg) translateZ(350px); }

    @keyframes spin-carousel {
        from { transform: rotateY(0deg); }
        to { transform: rotateY(-360deg); }
    }
    
    @media (max-width: 768px) {
        .carousel-container { height: 300px; }
        .carousel-item { width: 200px; height: 300px; }
        .carousel-3d { width: 200px; height: 300px; }
        .carousel-item:nth-child(1) { transform: rotateY(0deg) translateZ(200px); }
        .carousel-item:nth-child(2) { transform: rotateY(60deg) translateZ(200px); }
        .carousel-item:nth-child(3) { transform: rotateY(120deg) translateZ(200px); }
        .carousel-item:nth-child(4) { transform: rotateY(180deg) translateZ(200px); }
        .carousel-item:nth-child(5) { transform: rotateY(240deg) translateZ(200px); }
        .carousel-item:nth-child(6) { transform: rotateY(300deg) translateZ(200px); }
    }

    /* Stacked Cards Scroll Section */
    .facets-section {
        position: relative;
        height: 100vh;
        background-color: #050505;
        overflow: hidden;
        border-top: 1px solid rgba(201, 169, 110, 0.2);
    }
    .facets-header {
        position: absolute;
        top: 10%;
        width: 100%;
        text-align: center;
        z-index: 10;
    }
    .facets-container {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .facet-card {
        position: absolute;
        width: 80%;
        max-width: 600px;
        height: 60vh;
        background: #0f0f0f;
        border: 1px solid rgba(201, 169, 110, 0.5);
        border-radius: 20px;
        /* Removed backdrop-filter to prevent bleed-through on stacked elements */
        box-shadow: 0 30px 60px rgba(0,0,0,0.8), inset 0 0 30px rgba(201, 169, 110, 0.1);
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        padding: 40px;
        text-align: center;
        transform: translateY(150vh);
        opacity: 0;
    }
    .facet-card i {
        font-size: 5rem;
        color: var(--brand-gold, #c9a96e);
        margin-bottom: 30px;
        text-shadow: 0 0 20px rgba(201, 169, 110, 0.5);
    }
    .facet-card h3 {
        font-family: 'Playfair Display', serif;
        font-size: 3rem;
        color: var(--brand-gold, #c9a96e);
        margin-bottom: 20px;
    }
    .facet-card p {
        font-size: 1.2rem;
        color: rgba(255,255,255,0.8);
        line-height: 1.6;
    }
    .facet-card.card-1 {
        transform: translateY(0);
        opacity: 1;
    }
</style>

<section class="premium-dark-section" style="text-align: center; min-height: 80vh; display: flex; flex-direction: column; justify-content: center; align-items: center; overflow: hidden; background: radial-gradient(circle at center, #111 0%, #000 100%); border-top: none; padding-bottom: 100px;">
    <h2 style="font-family: 'Playfair Display', serif; font-size: 3.5rem; margin-bottom: 20px; color: var(--brand-gold, #c9a96e); position: relative; z-index: 20; letter-spacing: 2px;">The Lexoria Gallery</h2>
    <p style="color: rgba(255,255,255,0.7); max-width: 600px; margin: 0 auto 80px; position: relative; z-index: 20; font-size: 1.3rem; font-style: italic;">Explore our collections in three dimensions. Hover to pause.</p>
    
    <div class="carousel-container">
        <div class="carousel-3d" id="galleryCarousel">
            <div class="carousel-item">
                <img src="/frontend/images/catalog_ring_1781772698546.png" alt="Luxury Diamond Ring">
            </div>
            <div class="carousel-item">
                <img src="/frontend/images/catalog_necklace_1781772719179.png" alt="Diamond Necklace">
            </div>
            <div class="carousel-item">
                <img src="/frontend/images/catalog_earrings_1781772731898.png" alt="Diamond Earrings">
            </div>
            <div class="carousel-item">
                <img src="/frontend/images/catalog_bracelet_1781772744574.png" alt="Diamond Tennis Bracelet">
            </div>
            <div class="carousel-item">
                <img src="/frontend/images/catalog_macro_1781772852005.png" alt="Flawless Cut Diamond">
            </div>
            <div class="carousel-item">
                <img src="/frontend/images/catalog_box_1781772865355.png" alt="Engagement Ring in Box">
            </div>
        </div>
    </div>
</section>

<section class="facets-section" id="facetsSection">
    <div class="facets-header">
        <h2 style="font-family: 'Playfair Display', serif; font-size: 3.5rem; color: var(--brand-gold, #c9a96e); margin-bottom: 10px;">The Facets of Lexoria</h2>
        <p style="color: rgba(255,255,255,0.7); font-style: italic; font-size: 1.2rem;">Scroll to discover our core values.</p>
    </div>
    <div class="facets-container" id="facetsContainer">
        <div class="facet-card card-1">
            <i class="bi bi-gem"></i>
            <h3>Purity</h3>
            <p>Sourcing only the most flawless, brilliant stones in the world.</p>
        </div>
        <div class="facet-card card-2">
            <i class="bi bi-shield-check"></i>
            <h3>Trust</h3>
            <p>100% certified, conflict-free, and ethically sourced diamonds.</p>
        </div>
        <div class="facet-card card-3">
            <i class="bi bi-brush"></i>
            <h3>Artistry</h3>
            <p>Masterful bespoke designs handcrafted to absolute perfection.</p>
        </div>
        <div class="facet-card card-4">
            <i class="bi bi-clock-history"></i>
            <h3>Legacy</h3>
            <p>Decades of unparalleled craftsmanship and family heritage.</p>
        </div>
    </div>
</section>

<style>
/* 3D Timeline Tunnel */
.timeline-3d-wrapper {
    position: relative;
    width: 100%;
    height: 100vh;
    background: radial-gradient(circle at center, #111 0%, #000 100%);
    overflow: hidden;
    perspective: 1200px;
}
.timeline-3d-camera {
    width: 100%;
    height: 100%;
    transform-style: preserve-3d;
    position: absolute;
    top: 0; left: 0;
}
.time-card {
    position: absolute;
    top: 50%; left: 50%;
    width: 450px; height: auto;
    margin-left: -225px; margin-top: -150px;
    background: rgba(10,10,10,0.6);
    backdrop-filter: blur(15px);
    -webkit-backdrop-filter: blur(15px);
    border: 1px solid rgba(201, 169, 110, 0.3);
    border-radius: 15px;
    padding: 50px;
    text-align: center;
    box-shadow: 0 0 50px rgba(0,0,0,0.8), inset 0 0 20px rgba(201, 169, 110, 0.05);
}
.time-card h3 {
    font-family: 'Playfair Display', serif;
    font-size: 4rem;
    color: var(--brand-gold, #c9a96e);
    margin-bottom: 20px;
    text-shadow: 0 0 20px rgba(201, 169, 110, 0.5);
}
.time-card p {
    font-size: 1.2rem;
    color: rgba(255,255,255,0.8);
    line-height: 1.8;
}

/* Position cards deep into the Z-axis */
#tc-1 { transform: translate3d(-30%, 0, -1000px); }
#tc-2 { transform: translate3d(30%, 0, -3500px); }
#tc-3 { transform: translate3d(-30%, 0, -6000px); }
#tc-4 { transform: translate3d(30%, 0, -8500px); }
#tc-5 { transform: translate3d(0, 0, -11000px); } /* Final logo */
</style>

<section id="timelineSection" style="position: relative; height: 100vh;">
    <div class="timeline-3d-wrapper">
        <div style="position: absolute; top: 10%; width: 100%; text-align: center; z-index: 100;">
            <h2 style="font-family: 'Playfair Display', serif; font-size: 3rem; color: var(--brand-gold, #c9a96e); text-shadow: 0 5px 15px rgba(0,0,0,0.8);">A Journey Through Time</h2>
            <p style="color: rgba(255,255,255,0.7); font-style: italic; font-size: 1.2rem;">Scroll to travel through our legacy</p>
        </div>
        
        <div class="timeline-3d-camera" id="timelineCamera">
            <!-- Floating Stars/Dust -->
            <div style="position: absolute; width: 10px; height: 10px; background: #fff; border-radius: 50%; transform: translate3d(20vw, -20vh, -500px); opacity: 0.5;"></div>
            <div style="position: absolute; width: 5px; height: 5px; background: #c9a96e; border-radius: 50%; transform: translate3d(-30vw, 30vh, -2000px); opacity: 0.8;"></div>
            <div style="position: absolute; width: 15px; height: 15px; background: #fff; border-radius: 50%; transform: translate3d(40vw, 10vh, -4000px); opacity: 0.3; filter: blur(2px);"></div>
            <div style="position: absolute; width: 8px; height: 8px; background: #c9a96e; border-radius: 50%; transform: translate3d(-40vw, -30vh, -7000px); opacity: 0.6;"></div>

            <div class="time-card" id="tc-1">
                <h3>1985</h3>
                <p>The First Spark. Our visionary founder opens a small, dedicated diamond polishing workshop in the heart of Surat.</p>
            </div>
            <div class="time-card" id="tc-2">
                <h3>1998</h3>
                <p>Mastery Achieved. We become recognized internationally for our impeccable, flawless solitaire cuts, attracting global connoisseurs.</p>
            </div>
            <div class="time-card" id="tc-3">
                <h3>2010</h3>
                <p>A New Era. The Lexoria brand is officially born, bringing our legacy of wholesale perfection directly to the luxury retail market.</p>
            </div>
            <div class="time-card" id="tc-4">
                <h3>2024</h3>
                <p>Global Presence. Lexoria stands as a beacon of unmatched quality, a trusted name for heirlooms passed down for generations.</p>
            </div>
            <div class="time-card" id="tc-5" style="background: transparent; border: none; box-shadow: none;">
                <h1 style="font-family: 'Playfair Display', serif; font-size: 6rem; background: linear-gradient(to right, #fff, #c9a96e); -webkit-background-clip: text; color: transparent;">LEXORIA</h1>
                <p style="font-size: 1.5rem; color: #c9a96e; letter-spacing: 5px; text-transform: uppercase;">Eternity Awaits</p>
            </div>
        </div>
    </div>
</section>

</section>

<style>
/* 3D Holographic Section */
.hologram-section {
    position: relative;
    width: 100%;
    min-height: 100vh;
    background: #000;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    perspective: 1500px;
    padding: 100px 0;
    overflow: hidden;
}
.hologram-header {
    text-align: center;
    margin-bottom: 80px;
    z-index: 20;
}
.holo-container {
    width: 600px;
    height: 600px;
    position: relative;
    transform-style: preserve-3d;
    transition: transform 0.1s ease;
    cursor: crosshair;
}
.holo-layer {
    position: absolute;
    top: 0; left: 0;
    width: 100%; height: 100%;
    background-size: contain;
    background-position: center;
    background-repeat: no-repeat;
    pointer-events: none;
    display: flex;
    justify-content: center;
    align-items: center;
}
/* Layers pulled out into Z space */
.holo-bg {
    transform: translateZ(-200px);
    background: radial-gradient(circle at center, rgba(201,169,110,0.2) 0%, transparent 70%);
    opacity: 0.5;
}
.holo-particles {
    transform: translateZ(50px);
    background-image: url('data:image/svg+xml;utf8,<svg width="600" height="600" xmlns="http://www.w3.org/2000/svg"><circle cx="100" cy="100" r="3" fill="%23c9a96e" opacity="0.8"/><circle cx="500" cy="150" r="4" fill="%23fff" opacity="0.5"/><circle cx="200" cy="500" r="2" fill="%23c9a96e" opacity="0.9"/><circle cx="450" cy="450" r="3" fill="%23fff" opacity="0.6"/></svg>');
}
.holo-diamond {
    transform: translateZ(150px);
    /* Pure CSS diamond shape for holographic effect */
    width: 200px; height: 200px;
    background: rgba(255,255,255,0.05);
    border: 2px solid rgba(201, 169, 110, 0.8);
    box-shadow: 0 0 50px rgba(201, 169, 110, 0.4), inset 0 0 30px rgba(255,255,255,0.2);
    transform-style: preserve-3d;
    animation: slowSpin 20s linear infinite;
}
.holo-diamond::before, .holo-diamond::after {
    content: '';
    position: absolute;
    top: 0; left: 0;
    width: 100%; height: 100%;
    border: 2px solid rgba(201, 169, 110, 0.5);
}
.holo-diamond::before { transform: rotateX(45deg) rotateY(45deg); }
.holo-diamond::after { transform: rotateX(45deg) rotateY(-45deg); }

@keyframes slowSpin {
    0% { transform: translateZ(150px) rotateX(0) rotateY(0); }
    100% { transform: translateZ(150px) rotateX(360deg) rotateY(360deg); }
}

.holo-text {
    transform: translateZ(300px);
    font-family: 'Playfair Display', serif;
    font-size: 5rem;
    color: #fff;
    text-shadow: 0 10px 30px rgba(0,0,0,0.8);
}
</style>

<section class="hologram-section" id="hologramSection">
    <div class="hologram-header">
        <h2 style="font-family: 'Playfair Display', serif; font-size: 3.5rem; color: var(--brand-gold, #c9a96e);">Interactive 3D Hologram</h2>
        <p style="color: rgba(255,255,255,0.7); font-style: italic; font-size: 1.2rem;">Move your mouse across the space below to interact with the 3D dimensions.</p>
    </div>
    
    <div class="holo-container" id="holoContainer">
        <div class="holo-layer holo-bg"></div>
        <div class="holo-layer holo-particles"></div>
        <div class="holo-layer" style="display:flex; justify-content:center; align-items:center;">
            <div class="holo-diamond"></div>
        </div>
        <div class="holo-layer holo-text">PURE</div>
    </div>
</section>

<script>
    document.addEventListener("DOMContentLoaded", () => {
        if (typeof gsap !== 'undefined' && typeof ScrollTrigger !== 'undefined') {
            // Existing logic
            const facetsCards = gsap.utils.toArray('.facet-card:not(.card-1)');
            const facetsTl = gsap.timeline({
                scrollTrigger: { trigger: '#facetsSection', start: "top top", end: "+=3000", pin: true, scrub: 1 }
            });
            facetsCards.forEach((card, i) => { facetsTl.to(card, { y: 0, opacity: 1, duration: 1, ease: "power2.out" }); });

            if (document.getElementById('timelineSection')) {
                gsap.to("#timelineCamera", {
                    z: 12000, 
                    ease: "none",
                    scrollTrigger: { trigger: "#timelineSection", start: "top top", end: "+=5000", pin: true, scrub: 1 }
                });
            }

            // Hologram Mouse Tracking
            const holoContainer = document.getElementById('holoContainer');
            if(holoContainer) {
                document.addEventListener('mousemove', (e) => {
                    const rect = holoContainer.getBoundingClientRect();
                    // Only apply effect if the container is somewhat visible
                    if(rect.top > window.innerHeight || rect.bottom < 0) return;
                    
                    const centerX = window.innerWidth / 2;
                    const centerY = window.innerHeight / 2;
                    const mouseX = e.clientX;
                    const mouseY = e.clientY;
                    
                    const rotateX = ((mouseY - centerY) / centerY) * -20; // max 20deg tilt
                    const rotateY = ((mouseX - centerX) / centerX) * 20;  // max 20deg tilt
                    
                    gsap.to(holoContainer, {
                        rotateX: rotateX,
                        rotateY: rotateY,
                        duration: 0.5,
                        ease: "power2.out"
                    });
                });
            }
        }
    });
</script>

@include('frontend.footer')
