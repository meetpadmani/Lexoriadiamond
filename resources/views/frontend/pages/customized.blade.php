@include('frontend.navbar')

<!-- Google Fonts -->
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600&family=Playfair+Display:ital,wght@0,400;0,500;0,600;0,700;1,400;1,600&display=swap" rel="stylesheet">

<!-- GSAP & ScrollTrigger -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/ScrollTrigger.min.js"></script>

<style>
    :root {
        --c-bg: #050505;
        --c-text: #ffffff;
        --c-gold: #c9a96e;
        --c-gold-dark: #8b6914;
        --font-heading: 'Playfair Display', serif;
        --font-body: 'Inter', sans-serif;
    }

    body {
        background-color: var(--c-bg);
        color: var(--c-text);
        font-family: var(--font-body);
        margin: 0;
        overflow-x: hidden;
        cursor: none; /* Hide default cursor for custom cursor */
    }

    /* =========================================
       CUSTOM LUXURY CURSOR
    ========================================= */
    .custom-cursor-dot {
        position: fixed;
        top: 0; left: 0;
        width: 8px; height: 8px;
        background: var(--c-gold);
        border-radius: 50%;
        pointer-events: none;
        z-index: 9999;
        transform: translate(-50%, -50%);
        transition: width 0.2s, height 0.2s;
    }
    .custom-cursor-ring {
        position: fixed;
        top: 0; left: 0;
        width: 40px; height: 40px;
        border: 1px solid rgba(201, 169, 110, 0.5);
        border-radius: 50%;
        pointer-events: none;
        z-index: 9998;
        transform: translate(-50%, -50%);
        transition: transform 0.15s ease-out, width 0.2s, height 0.2s, border-color 0.2s;
    }
    body:hover .custom-cursor-dot, body:hover .custom-cursor-ring {
        opacity: 1;
    }
    
    .cursor-hover .custom-cursor-dot {
        background: transparent;
    }
    .cursor-hover .custom-cursor-ring {
        width: 60px; height: 60px;
        border-color: var(--c-gold);
        background: rgba(201, 169, 110, 0.1);
    }

    .customized-wrapper {
        position: relative;
        width: 100%;
        overflow-x: hidden;
    }

    /* =========================================
       SECTION 1: 3D HERO (PINNED PARALLAX)
    ========================================= */
    .c-hero-pin-wrapper {
        width: 100%;
        height: 100vh;
        position: relative;
        overflow: hidden;
    }

    .c-hero-bg {
        position: absolute;
        top: -10%; left: -10%; width: 120%; height: 120%;
        background-image: url('{{ asset("images/jewelry-cad.png") }}');
        background-size: cover;
        background-position: center;
        filter: brightness(0.4) contrast(1.2);
        z-index: 1;
        will-change: transform;
    }

    .c-hero-content {
        position: absolute;
        top: 50%; left: 50%;
        transform: translate(-50%, -50%);
        text-align: center;
        z-index: 2;
        width: 100%;
        perspective: 1000px;
    }

    .c-hero-title {
        font-family: var(--font-heading);
        font-size: clamp(4rem, 8vw, 7rem);
        font-weight: 500;
        margin: 0;
        line-height: 1.1;
        transform-style: preserve-3d;
        background: linear-gradient(135deg, #ffffff 30%, var(--c-gold) 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        text-shadow: 0 20px 40px rgba(0,0,0,0.5);
    }
    
    .c-hero-subtitle {
        font-family: var(--font-body);
        font-size: 1.2rem;
        letter-spacing: 10px;
        text-transform: uppercase;
        color: var(--c-gold);
        margin-top: 20px;
        opacity: 0.8;
    }

    .c-scroll-indicator {
        position: absolute;
        bottom: 50px;
        left: 50%;
        transform: translateX(-50%);
        z-index: 3;
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 15px;
        opacity: 0.6;
    }

    .c-scroll-text {
        font-family: var(--font-body);
        font-size: 0.7rem;
        letter-spacing: 4px;
        text-transform: uppercase;
        color: #fff;
    }

    .c-scroll-line {
        width: 1px;
        height: 60px;
        background: linear-gradient(to bottom, var(--c-gold), transparent);
        animation: scrollLine 2s infinite ease-in-out;
    }

    @keyframes scrollLine {
        0% { transform: scaleY(0); transform-origin: top; }
        50% { transform: scaleY(1); transform-origin: top; }
        50.1% { transform: scaleY(1); transform-origin: bottom; }
        100% { transform: scaleY(0); transform-origin: bottom; }
    }

    /* Particles */
    #c-particles {
        position: absolute;
        inset: 0;
        z-index: 1;
        overflow: hidden;
        pointer-events: none;
    }
    
    .c-particle {
        position: absolute;
        background: var(--c-gold);
        border-radius: 50%;
        opacity: 0;
        box-shadow: 0 0 10px var(--c-gold), 0 0 20px var(--c-gold);
    }

    /* =========================================
       SECTION 2: 3D HORIZONTAL PROCESS
    ========================================= */
    .c-process-container {
        width: 100%;
        height: 100vh;
        background: #0a0a0a;
        position: relative;
        display: flex;
        align-items: center;
        overflow: hidden;
        border-top: 1px solid rgba(201, 169, 110, 0.1);
    }

    .c-process-header {
        position: absolute;
        top: 10%;
        left: 10%;
        z-index: 10;
    }

    .c-process-header h2 {
        font-family: var(--font-heading);
        font-size: 3rem;
        color: #fff;
        margin: 0;
    }
    .c-process-header span {
        color: var(--c-gold);
        font-style: italic;
    }

    .c-cards-track {
        display: flex;
        gap: 100px;
        padding-left: 10%;
        width: max-content;
        perspective: 1500px;
    }

    .c-step-card {
        width: 400px;
        height: 500px;
        background: rgba(20, 20, 20, 0.8);
        border: 1px solid rgba(201, 169, 110, 0.2);
        backdrop-filter: blur(10px);
        -webkit-backdrop-filter: blur(10px);
        padding: 60px 40px;
        display: flex;
        flex-direction: column;
        position: relative;
        transform-style: preserve-3d;
        box-shadow: 0 30px 60px rgba(0,0,0,0.8);
        transition: transform 0.4s ease, border-color 0.4s ease, background 0.4s ease;
    }
    
    .c-step-card:hover {
        background: rgba(30, 30, 30, 0.9);
        border-color: rgba(201, 169, 110, 0.5);
        transform: translateZ(30px) !important;
        box-shadow: 0 40px 80px rgba(0,0,0,1), 0 0 30px rgba(201, 169, 110, 0.1);
    }

    .c-step-num {
        font-family: var(--font-heading);
        font-size: 6rem;
        color: rgba(201, 169, 110, 0.1);
        position: absolute;
        top: 20px;
        right: 30px;
        line-height: 1;
        font-weight: 700;
        z-index: 1;
    }

    .c-step-icon {
        font-size: 3rem;
        color: var(--c-gold);
        margin-bottom: 30px;
        z-index: 2;
    }

    .c-step-title {
        font-family: var(--font-heading);
        font-size: 2rem;
        color: #fff;
        margin-bottom: 20px;
        z-index: 2;
    }

    .c-step-desc {
        font-family: var(--font-body);
        color: rgba(255,255,255,0.7);
        font-size: 1.1rem;
        line-height: 1.8;
        z-index: 2;
    }

    /* =========================================
       SECTION 3: 3D GALLERY REVEAL
    ========================================= */
    .c-gallery-section {
        padding: 150px 5%;
        background: radial-gradient(circle at center, #111 0%, #050505 100%);
        perspective: 1200px;
    }

    .c-gallery-header {
        text-align: center;
        margin-bottom: 100px;
    }

    .c-gallery-header h2 {
        font-family: var(--font-heading);
        font-size: 3.5rem;
        margin: 0 0 20px;
    }

    .c-gallery-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 30px;
        transform-style: preserve-3d;
    }

    .c-gallery-item {
        position: relative;
        border-radius: 4px;
        overflow: hidden;
        height: 450px;
        border: 1px solid rgba(255,255,255,0.05);
        transform: rotateX(20deg) rotateY(10deg) translateZ(-100px);
        opacity: 0;
        box-shadow: 20px 30px 50px rgba(0,0,0,0.8);
    }

    .c-gallery-item img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.6s ease;
    }

    .c-gallery-item:hover img {
        transform: scale(1.1);
    }

    .c-gallery-overlay {
        position: absolute;
        inset: 0;
        background: linear-gradient(to top, rgba(0,0,0,0.9), transparent 50%);
        display: flex;
        align-items: flex-end;
        padding: 30px;
        opacity: 0;
        transition: opacity 0.4s ease;
    }

    .c-gallery-item:hover .c-gallery-overlay {
        opacity: 1;
    }

    .c-gallery-info h4 {
        font-family: var(--font-heading);
        font-size: 1.5rem;
        color: #fff;
        margin: 0 0 5px;
        transform: translateY(20px);
        transition: transform 0.4s ease;
    }

    .c-gallery-info p {
        font-family: var(--font-body);
        font-size: 0.8rem;
        color: var(--c-gold);
        text-transform: uppercase;
        letter-spacing: 2px;
        margin: 0;
        transform: translateY(20px);
        transition: transform 0.4s ease 0.1s;
    }

    .c-gallery-item:hover .c-gallery-info h4,
    .c-gallery-item:hover .c-gallery-info p {
        transform: translateY(0);
    }

    /* =========================================
       SECTION 4: LUXURY FORM
    ========================================= */
    .c-form-section {
        padding: 150px 5%;
        background: #050505;
        position: relative;
    }

    .c-form-section::before {
        content: '';
        position: absolute;
        top: 0; left: 0; right: 0; height: 1px;
        background: linear-gradient(90deg, transparent, var(--c-gold), transparent);
        opacity: 0.3;
    }

    .c-form-container {
        max-width: 900px;
        margin: 0 auto;
        background: rgba(15, 15, 15, 0.9);
        border: 1px solid rgba(201, 169, 110, 0.2);
        padding: 70px;
        border-radius: 12px;
        box-shadow: 0 40px 100px rgba(0,0,0,0.9);
        position: relative;
        backdrop-filter: blur(20px);
        -webkit-backdrop-filter: blur(20px);
    }

    .c-form-header {
        text-align: center;
        margin-bottom: 50px;
    }

    .c-form-header h2 {
        font-family: var(--font-heading);
        font-size: 3.5rem;
        color: #fff;
        margin: 0 0 15px;
    }

    .c-form-header p {
        font-family: var(--font-body);
        color: rgba(255,255,255,0.6);
        font-size: 1.1rem;
    }

    /* Alert Styling */
    .c-alert {
        padding: 20px;
        border-radius: 8px;
        margin-bottom: 40px;
        font-family: var(--font-body);
        display: flex;
        align-items: center;
        gap: 15px;
    }
    .c-alert-success {
        background: rgba(46, 125, 50, 0.1);
        border: 1px solid rgba(46, 125, 50, 0.3);
        color: #81c784;
    }
    .c-alert-error {
        background: rgba(211, 47, 47, 0.1);
        border: 1px solid rgba(211, 47, 47, 0.3);
        color: #e57373;
    }

    /* Form Fields */
    .c-form-group {
        margin-bottom: 35px;
    }

    .c-label {
        display: block;
        font-family: var(--font-body);
        font-size: 0.85rem;
        text-transform: uppercase;
        letter-spacing: 2px;
        color: var(--c-gold);
        margin-bottom: 12px;
        font-weight: 600;
    }

    .c-input {
        width: 100%;
        background: rgba(255, 255, 255, 0.06);
        border: 1px solid rgba(201, 169, 110, 0.3);
        padding: 20px 25px;
        color: #fff;
        font-family: var(--font-body);
        font-size: 1.05rem;
        border-radius: 8px;
        transition: all 0.3s ease;
        box-sizing: border-box;
    }

    .c-input:focus {
        outline: none;
        border-color: var(--c-gold);
        background: rgba(201, 169, 110, 0.08);
        box-shadow: 0 0 20px rgba(201, 169, 110, 0.2), inset 0 0 10px rgba(201, 169, 110, 0.05);
    }

    .c-input::placeholder {
        color: rgba(255,255,255,0.2);
    }

    /* File Upload */
    .c-file-upload {
        border: 1px dashed rgba(201, 169, 110, 0.3);
        padding: 60px 30px;
        text-align: center;
        border-radius: 4px;
        background: rgba(255,255,255,0.02);
        cursor: pointer;
        position: relative;
        transition: all 0.3s ease;
    }

    .c-file-upload:hover {
        border-color: var(--c-gold);
        background: rgba(201, 169, 110, 0.05);
    }

    .c-file-icon {
        font-size: 3rem;
        color: var(--c-gold);
        margin-bottom: 15px;
    }

    .c-file-text {
        font-size: 1.1rem;
        color: #fff;
        margin-bottom: 5px;
        display: block;
    }
    
    .c-file-subtext {
        font-size: 0.85rem;
        color: rgba(255,255,255,0.4);
    }

    .c-file-input {
        position: absolute;
        top: 0; left: 0; width: 100%; height: 100%;
        opacity: 0 !important; cursor: pointer;
        z-index: 10;
        /* Hide the text in webkit just in case */
        color: transparent; 
    }
    .c-file-input::-webkit-file-upload-button {
        visibility: hidden;
    }

    #c-image-previews {
        display: flex;
        flex-wrap: wrap;
        gap: 15px;
        margin-top: 20px;
    }

    .c-preview-box {
        width: 100px;
        height: 100px;
        border-radius: 4px;
        overflow: hidden;
        border: 1px solid rgba(201, 169, 110, 0.3);
    }

    .c-preview-box img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .c-submit-btn {
        width: 100%;
        padding: 20px;
        background: linear-gradient(135deg, var(--c-gold) 0%, var(--c-gold-dark) 100%);
        color: #050505;
        border: none;
        border-radius: 4px;
        font-family: var(--font-body);
        font-size: 1.1rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 2px;
        cursor: pointer;
        transition: all 0.4s ease;
        margin-top: 30px;
        box-shadow: 0 15px 30px rgba(201, 169, 110, 0.2);
    }

    .c-submit-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 20px 40px rgba(201, 169, 110, 0.4);
        background: #fff;
    }
    
    /* Form Layout Fixes */
    .c-form-row {
        display: flex;
        gap: 30px;
    }
    .c-form-half {
        flex: 1;
    }

    @media (max-width: 991px) {
        .c-form-container {
            padding: 40px 25px;
        }
        .c-step-card {
            width: 320px;
            height: 420px;
            padding: 40px 25px;
        }
    }
    @media (max-width: 768px) {
        .c-process-header h2 { font-size: 2.2rem; }
        .c-gallery-header h2 { font-size: 2.5rem; }
        .c-form-header h2 { font-size: 2.5rem; }
        
        .c-form-row {
            flex-direction: column;
            gap: 0;
        }
    }
</style>

<div class="customized-wrapper">
    <!-- Custom Cursor Elements -->
    <div class="custom-cursor-dot"></div>
    <div class="custom-cursor-ring"></div>

    <!-- SECTION 1: 3D HERO (PINNED PARALLAX) -->
    <section class="c-hero-pin-wrapper" id="c-hero">
        <div class="c-hero-bg"></div>
        <div id="c-particles"></div>
        <div class="c-hero-content">
            <h1 class="c-hero-title">Customized<br><em>Masterpieces</em></h1>
            <div class="c-hero-subtitle">Your Imagination, Forged in Gold</div>
        </div>
        <div class="c-scroll-indicator">
            <div class="c-scroll-text">Scroll to Discover</div>
            <div class="c-scroll-line"></div>
        </div>
    </section>

    <!-- SECTION 2: 3D HORIZONTAL PROCESS -->
    <section class="c-process-container" id="c-process">
        <div class="c-process-header">
            <h2>The Bespoke <span>Journey</span></h2>
        </div>
        <div class="c-cards-track" id="c-track">
            
            <div class="c-step-card">
                <div class="c-step-num">01</div>
                <div class="c-step-icon"><i class="bi bi-bezier2"></i></div>
                <h3 class="c-step-title">Share Your Vision</h3>
                <p class="c-step-desc">Upload your inspiration—be it a rough sketch, a photograph, or simply a vivid description. Our artisans will translate your ideas into a detailed design concept.</p>
            </div>
            
            <div class="c-step-card">
                <div class="c-step-num">02</div>
                <div class="c-step-icon"><i class="bi bi-badge-3d"></i></div>
                <h3 class="c-step-title">Digital Perfection</h3>
                <p class="c-step-desc">We craft a high-fidelity 3D CAD model of your jewelry. You will review every millimeter in stunning 3D, allowing for infinite refinements before forging.</p>
            </div>
            
            <div class="c-step-card">
                <div class="c-step-num">03</div>
                <div class="c-step-icon"><i class="bi bi-hammer"></i></div>
                <h3 class="c-step-title">Master Craftsmanship</h3>
                <p class="c-step-desc">Upon your final approval, our master jewelers cast the design in precious metals and meticulously hand-set every stone to flawless perfection.</p>
            </div>
            
        </div>
    </section>

    <!-- SECTION 3: 3D GALLERY REVEAL -->
    <section class="c-gallery-section" id="c-gallery">
        <div class="c-gallery-header">
            <h2>A Symphony of <em>Craft</em></h2>
        </div>
        <div class="c-gallery-grid">
            <div class="c-gallery-item">
                <img src="{{ asset('frontend/images/catalog_ring_1781772698546.png') }}" alt="Ring">
                <div class="c-gallery-overlay">
                    <div class="c-gallery-info">
                        <h4>The Eternity Band</h4>
                        <p>18k White Gold & Diamonds</p>
                    </div>
                </div>
            </div>
            <div class="c-gallery-item">
                <img src="{{ asset('frontend/images/catalog_necklace_1781772719179.png') }}" alt="Necklace">
                <div class="c-gallery-overlay">
                    <div class="c-gallery-info">
                        <h4>Oceanic Sapphire</h4>
                        <p>Platinum & Ceylon Sapphire</p>
                    </div>
                </div>
            </div>
            <div class="c-gallery-item">
                <img src="{{ asset('frontend/images/catalog_bracelet_1781772744574.png') }}" alt="Bracelet">
                <div class="c-gallery-overlay">
                    <div class="c-gallery-info">
                        <h4>Sunburst Bangles</h4>
                        <p>22k Yellow Gold</p>
                    </div>
                </div>
            </div>
            <div class="c-gallery-item">
                <img src="{{ asset('frontend/images/catalog_earrings_1781772731898.png') }}" alt="Earrings">
                <div class="c-gallery-overlay">
                    <div class="c-gallery-info">
                        <h4>Emerald Drops</h4>
                        <p>18k Gold & Colombian Emeralds</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- SECTION 4: LUXURY FORM -->
    <section class="c-form-section" id="c-form">
        <div class="c-form-container">
            <div class="c-form-header">
                <h2>Start Your <em>Legacy</em></h2>
                <p>Submit your details to request a bespoke design consultation.</p>
            </div>

            @if(session('success'))
                <div class="c-alert c-alert-success">
                    <i class="bi bi-check-circle-fill fs-4"></i>
                    <span>{{ session('success') }}</span>
                </div>
            @endif
            
            @if($errors->any())
                <div class="c-alert c-alert-error">
                    <i class="bi bi-exclamation-triangle-fill fs-4"></i>
                    <div>
                        <strong>Please correct the following:</strong>
                        <ul style="margin: 5px 0 0; padding-left: 20px;">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endif

            <form action="{{ route('customized.submit') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="c-form-row">
                    <div class="c-form-group c-form-half">
                        <label class="c-label">Full Name</label>
                        <input type="text" name="name" class="c-input" required placeholder="John Doe">
                    </div>
                    <div class="c-form-group c-form-half">
                        <label class="c-label">Phone Number</label>
                        <input type="tel" name="phone" class="c-input" required placeholder="+1 (555) 000-0000">
                    </div>
                </div>

                <div class="c-form-group">
                    <label class="c-label">Email Address</label>
                    <input type="email" name="email" class="c-input" required placeholder="john@example.com">
                </div>

                <div class="c-form-group">
                    <label class="c-label">Design Description</label>
                    <textarea name="description" class="c-input" rows="5" required placeholder="Describe your dream jewelry in vivid detail..."></textarea>
                </div>

                <div class="c-form-group">
                    <label class="c-label">Upload Inspiration</label>
                    <div class="c-file-upload" id="c-file-wrapper">
                        <i class="bi bi-cloud-arrow-up c-file-icon"></i>
                        <span class="c-file-text" id="c-file-name">Click or drag images to upload</span>
                        <span class="c-file-subtext">Supported formats: JPG, PNG, WEBP (Multiple allowed)</span>
                        <input type="file" name="images[]" id="c-design-images" accept="image/*" multiple required onchange="handleCFileSelect(event)" class="c-file-input">
                    </div>
                    <div id="c-image-previews"></div>
                </div>

                <button type="submit" class="c-submit-btn">Begin Consultation</button>
            </form>
        </div>
    </section>

</div>

<script>
    // File Upload Logic (Preserved and adapted to new IDs)
    function handleCFileSelect(event) {
        const files = event.target.files;
        const previewContainer = document.getElementById('c-image-previews');
        const fileNameDisplay = document.getElementById('c-file-name');
        
        previewContainer.innerHTML = '';
        
        if (files.length === 0) {
            fileNameDisplay.innerText = 'Click or drag images to upload';
            fileNameDisplay.style.color = '#fff';
            return;
        }
        
        fileNameDisplay.innerText = files.length + ' image(s) selected';
        fileNameDisplay.style.color = 'var(--c-gold)';
        
        for (let i = 0; i < files.length; i++) {
            const file = files[i];
            if (!file.type.match('image.*')) continue;
            
            const reader = new FileReader();
            reader.onload = (function(theFile) {
                return function(e) {
                    const div = document.createElement('div');
                    div.className = 'c-preview-box';
                    const img = document.createElement('img');
                    img.src = e.target.result;
                    img.title = escape(theFile.name);
                    div.appendChild(img);
                    previewContainer.appendChild(div);
                };
            })(file);
            reader.readAsDataURL(file);
        }
    }
    
    // Drag & Drop
    const cWrapper = document.getElementById('c-file-wrapper');
    const cFileInput = document.getElementById('c-design-images');
    
    if(cWrapper && cFileInput) {
        cWrapper.addEventListener('dragover', (e) => {
            e.preventDefault();
            cWrapper.style.borderColor = 'var(--c-gold)';
            cWrapper.style.background = 'rgba(201, 169, 110, 0.1)';
        });
        
        cWrapper.addEventListener('dragleave', (e) => {
            e.preventDefault();
            cWrapper.style.borderColor = 'rgba(201, 169, 110, 0.3)';
            cWrapper.style.background = 'rgba(255,255,255,0.02)';
        });
        
        cWrapper.addEventListener('drop', (e) => {
            e.preventDefault();
            cWrapper.style.borderColor = 'rgba(201, 169, 110, 0.3)';
            cWrapper.style.background = 'rgba(255,255,255,0.02)';
            
            if (e.dataTransfer.files.length > 0) {
                cFileInput.files = e.dataTransfer.files;
                handleCFileSelect({target: cFileInput});
            }
        });
    }

    // ==========================================
    // CUSTOM CURSOR LOGIC
    // ==========================================
    const cursorDot = document.querySelector('.custom-cursor-dot');
    const cursorRing = document.querySelector('.custom-cursor-ring');
    
    if (cursorDot && cursorRing && window.innerWidth > 991) {
        window.addEventListener('mousemove', (e) => {
            const posX = e.clientX;
            const posY = e.clientY;
            
            cursorDot.style.left = `${posX}px`;
            cursorDot.style.top = `${posY}px`;
            
            // Add a tiny delay to the ring for a smooth trailing effect
            cursorRing.style.transform = `translate(calc(-50% + ${posX}px), calc(-50% + ${posY}px))`;
        });
        
        // Add hover effect to interactive elements
        const interactives = document.querySelectorAll('a, button, input, textarea, .c-step-card, .c-gallery-item, .c-file-upload');
        interactives.forEach(el => {
            el.addEventListener('mouseenter', () => {
                document.body.classList.add('cursor-hover');
            });
            el.addEventListener('mouseleave', () => {
                document.body.classList.remove('cursor-hover');
            });
        });
    }

    // ==========================================
    // GSAP 3D SCROLL ANIMATIONS
    // ==========================================
    document.addEventListener('DOMContentLoaded', () => {
        gsap.registerPlugin(ScrollTrigger);

        // 1. Hero 3D Zoom out & Fade
        const heroTl = gsap.timeline({
            scrollTrigger: {
                trigger: "#c-hero",
                start: "top top",
                end: "+=100%",
                scrub: 1,
                pin: true
            }
        });

        heroTl.to(".c-hero-bg", { scale: 1.5, opacity: 0.2, filter: "blur(10px)", duration: 1 })
              .to(".c-hero-title", { scale: 1.2, opacity: 0, translateZ: 500, duration: 1 }, 0)
              .to(".c-hero-subtitle", { y: -50, opacity: 0, duration: 0.5 }, 0)
              .to(".c-scroll-indicator", { opacity: 0, duration: 0.3 }, 0);


        // 2. Horizontal 3D Process Scroll
        // Only run horizontal scroll if screen is wider than 991px
        if (window.innerWidth > 991) {
            const cardsTrack = document.getElementById("c-track");
            
            if (cardsTrack) {
                function getScrollAmount() {
                    let cardsWidth = cardsTrack.scrollWidth;
                    return -(cardsWidth - window.innerWidth + 200);
                }

                const tween = gsap.to(cardsTrack, {
                    x: getScrollAmount,
                    duration: 3,
                    ease: "none"
                });

                ScrollTrigger.create({
                    trigger: "#c-process",
                    start: "top top",
                    end: () => `+=${getScrollAmount() * -1}`,
                    pin: true,
                    animation: tween,
                    scrub: 1,
                    invalidateOnRefresh: true
                });

                // 3D pop effect for cards as they scroll horizontally
                gsap.utils.toArray('.c-step-card').forEach(card => {
                    gsap.from(card, {
                        scrollTrigger: {
                            trigger: card,
                            containerAnimation: tween,
                            start: "left center+=300",
                            end: "left center-=300",
                            scrub: true
                        },
                        rotateY: -30,
                        scale: 0.8,
                        translateZ: -200,
                        opacity: 0.5
                    });
                });
            }
        } else {
            // Mobile vertical reveal
            gsap.utils.toArray('.c-step-card').forEach(card => {
                gsap.from(card, {
                    scrollTrigger: {
                        trigger: card,
                        start: "top 85%",
                    },
                    y: 100,
                    opacity: 0,
                    duration: 1,
                    ease: "power3.out"
                });
            });
        }

        // 3. Gallery 3D Unfold
        gsap.utils.toArray('.c-gallery-item').forEach(item => {
            gsap.to(item, {
                scrollTrigger: {
                    trigger: item,
                    start: "top 90%",
                    end: "top 50%",
                    scrub: 1
                },
                rotateX: 0,
                rotateY: 0,
                translateZ: 0,
                opacity: 1
            });
        });

        // 4. Form Entrance
        gsap.from(".c-form-container", {
            scrollTrigger: {
                trigger: "#c-form",
                start: "top 80%",
            },
            y: 100,
            opacity: 0,
            duration: 1.5,
            ease: "power4.out"
        });

        // 5. Generate Hero Particles
        const particleContainer = document.getElementById('c-particles');
        if (particleContainer && window.innerWidth > 768) {
            for (let i = 0; i < 40; i++) {
                const p = document.createElement('div');
                p.classList.add('c-particle');
                
                // Random size, position
                const size = Math.random() * 3 + 1;
                p.style.width = `${size}px`;
                p.style.height = `${size}px`;
                p.style.left = `${Math.random() * 100}%`;
                p.style.top = `${Math.random() * 100}%`;
                
                particleContainer.appendChild(p);

                // Animate infinitely
                gsap.to(p, {
                    y: `-=${Math.random() * 100 + 50}`,
                    x: `+=${(Math.random() - 0.5) * 50}`,
                    opacity: Math.random() * 0.5 + 0.1,
                    duration: Math.random() * 10 + 5,
                    repeat: -1,
                    yoyo: true,
                    ease: "sine.inOut",
                    delay: Math.random() * -10
                });
            }
            
            // Hero parallax fades out particles on scroll too
            heroTl.to("#c-particles", { opacity: 0, duration: 1 }, 0);
        }
    });
</script>

@include('frontend.footer')
