<section class="custom-design-banner" id="cdb-section">
    <div class="cdb-container">
        <!-- Left Side: Image & Holographic UI Elements -->
        <div class="cdb-image-half reveal-left">
            <div class="cdb-image-wrapper">
                <img src="{{ asset('images/jewelry-cad.png') }}" alt="High-Tech Jewelry CAD Design" class="cdb-image">
                
                <!-- Advanced UI Overlay -->
                <div class="cdb-hologram-overlay"></div>
                
                <!-- Floating Glassmorphism Badge -->
                <div class="cdb-floating-badge reveal-scale">
                    <div class="cdb-badge-icon">
                        <i class="bi bi-badge-3d"></i>
                    </div>
                    <div class="cdb-badge-text">
                        <span>Precision Crafted</span>
                        <strong>100% Custom CAD</strong>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Right Side: Content -->
        <div class="cdb-content-half">
            <div class="cdb-content-inner">
                <div class="cdb-motif reveal-up" style="transition-delay: 0.1s;">
                    <svg width="40" height="40" viewBox="0 0 100 100" fill="none" stroke="#C9A96E" stroke-width="1.5">
                        <circle cx="50" cy="50" r="40" stroke-dasharray="4 4" stroke="rgba(201, 169, 110, 0.4)" />
                        <path d="M50 20 L60 40 L80 50 L60 60 L50 80 L40 60 L20 50 L40 40 Z" fill="rgba(201, 169, 110, 0.15)"/>
                        <circle cx="50" cy="50" r="5" fill="#C9A96E" />
                    </svg>
                </div>
                
                <span class="cdb-subtitle reveal-up" style="transition-delay: 0.2s;">The Future of Bespoke</span>
                <h2 class="cdb-title reveal-up" style="transition-delay: 0.3s;">Designing <br><span class="text-gold-gradient">Digital Perfection</span></h2>
                
                <div class="cdb-divider reveal-scale" style="transition-delay: 0.4s;"></div>
                
                <p class="cdb-text reveal-up" style="transition-delay: 0.5s;">
                    Experience the pinnacle of personalization. Work directly with our master artisans and high-end 3D architects to bring your dream jewelry to life. Watch your imagination transform into a stunning 3D reality before it's ever cast in gold.
                </p>
                
                <div class="reveal-up" style="transition-delay: 0.6s;">
                    <a href="{{ route('customized') }}" class="cdb-btn cdb-btn-solid">
                        Start Customizing
                        <span class="cdb-btn-icon">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <line x1="5" y1="12" x2="19" y2="12"></line>
                                <polyline points="12 5 19 12 12 19"></polyline>
                            </svg>
                        </span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
    .custom-design-banner {
        width: 100%;
        background-color: #0F1F17;
        border-top: 1px solid rgba(201, 169, 110, 0.15);
        border-bottom: 1px solid rgba(201, 169, 110, 0.15);
        position: relative;
        overflow: hidden;
    }

    .cdb-container {
        display: flex;
        flex-wrap: wrap;
        min-height: 700px;
        width: 100%;
    }

    /* Scroll Reveal Animations */
    .reveal-up {
        opacity: 0;
        transform: translateY(40px);
        transition: all 0.8s cubic-bezier(0.165, 0.84, 0.44, 1);
    }
    .reveal-left {
        opacity: 0;
        transform: translateX(-50px);
        transition: all 1s cubic-bezier(0.165, 0.84, 0.44, 1);
    }
    .reveal-scale {
        opacity: 0;
        transform: scale(0.8);
        transition: all 0.8s cubic-bezier(0.165, 0.84, 0.44, 1);
    }
    
    .cdb-section-visible .reveal-up {
        opacity: 1;
        transform: translateY(0);
    }
    .cdb-section-visible .reveal-left {
        opacity: 1;
        transform: translateX(0);
    }
    .cdb-section-visible .reveal-scale {
        opacity: 1;
        transform: scale(1);
    }

    /* Left Side: Image & UI */
    .cdb-image-half {
        flex: 1;
        min-width: 50%;
        position: relative;
        overflow: hidden;
        background: #000;
    }

    .cdb-image-wrapper {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        perspective: 1000px;
    }

    .cdb-image {
        width: 100%;
        height: 100%;
        object-fit: cover;
        object-position: center;
        transition: transform 5s cubic-bezier(0.165, 0.84, 0.44, 1);
        filter: contrast(1.1) brightness(0.9);
    }

    .cdb-section-visible .cdb-image {
        transform: scale(1.05); /* Auto slow-zoom on reveal */
    }

    .cdb-image-half:hover .cdb-image {
        transform: scale(1.1) rotate(1deg);
        filter: contrast(1.2) brightness(1.1);
    }

    /* Cinematic Hologram Effect */
    .cdb-hologram-overlay {
        position: absolute;
        inset: 0;
        background: 
            linear-gradient(90deg, transparent 0%, rgba(15, 31, 23, 0.4) 80%, #0F1F17 100%),
            repeating-linear-gradient(0deg, transparent, transparent 2px, rgba(0, 255, 255, 0.02) 2px, rgba(0, 255, 255, 0.02) 4px);
        pointer-events: none;
        z-index: 2;
    }

    /* Floating Glassmorphism Badge */
    .cdb-floating-badge {
        position: absolute;
        bottom: 50px;
        left: 50px;
        z-index: 10;
        background: rgba(15, 31, 23, 0.5);
        backdrop-filter: blur(15px);
        -webkit-backdrop-filter: blur(15px);
        border: 1px solid rgba(201, 169, 110, 0.4);
        border-radius: 16px;
        padding: 15px 25px;
        display: flex;
        align-items: center;
        gap: 15px;
        box-shadow: 0 20px 40px rgba(0,0,0,0.6), inset 0 0 20px rgba(201, 169, 110, 0.15);
        animation: cdb-float 6s ease-in-out infinite alternate;
    }

    @keyframes cdb-float {
        0% { transform: translateY(0); }
        100% { transform: translateY(-15px); }
    }

    .cdb-badge-icon {
        font-size: 2.2rem;
        color: #C9A96E;
        filter: drop-shadow(0 0 10px rgba(201, 169, 110, 0.5));
    }

    .cdb-badge-text {
        display: flex;
        flex-direction: column;
    }

    .cdb-badge-text span {
        font-family: 'Inter', sans-serif;
        color: rgba(255, 255, 255, 0.7);
        font-size: 0.75rem;
        text-transform: uppercase;
        letter-spacing: 2px;
        margin-bottom: 2px;
    }

    .cdb-badge-text strong {
        font-family: 'Playfair Display', serif;
        color: #fff;
        font-size: 1.15rem;
        letter-spacing: 0.5px;
    }

    /* Right Side: Content */
    .cdb-content-half {
        flex: 1;
        min-width: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        background-color: #0F1F17; 
        padding: 80px 60px;
        position: relative;
        z-index: 3;
    }

    .cdb-content-half::before {
        content: '';
        position: absolute;
        inset: 0;
        background-image: 
            radial-gradient(circle at 100% 0%, rgba(201, 169, 110, 0.08) 0%, transparent 50%),
            url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M30 0L60 30L30 60L0 30Z' fill='none' stroke='%23C9A96E' stroke-opacity='0.05' stroke-width='1'/%3E%3C/svg%3E");
        pointer-events: none;
    }

    .cdb-content-inner {
        max-width: 550px;
        width: 100%;
        position: relative;
        z-index: 4;
    }

    .cdb-motif {
        margin-bottom: 25px;
        animation: float-motif-spin 10s linear infinite;
    }

    @keyframes float-motif-spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }

    .cdb-subtitle {
        font-family: 'Inter', sans-serif;
        color: #C9A96E;
        font-size: 0.85rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 6px;
        margin-bottom: 20px;
        display: block;
        text-shadow: 0 2px 10px rgba(201, 169, 110, 0.2);
    }

    .cdb-title {
        font-family: 'Playfair Display', serif;
        font-size: 4.8rem;
        color: #ffffff;
        margin-bottom: 30px;
        line-height: 1.05;
        font-weight: 600;
        letter-spacing: -1.5px;
        text-shadow: 0 10px 30px rgba(0,0,0,0.5);
    }

    .text-gold-gradient {
        background: linear-gradient(135deg, #E5C07B 0%, #C9A96E 50%, #8B6914 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        display: inline-block;
    }

    .cdb-divider {
        width: 80px;
        height: 3px;
        background: linear-gradient(90deg, #C9A96E, #8B6914);
        margin-bottom: 35px;
        border-radius: 2px;
    }

    .cdb-text {
        font-family: 'Inter', sans-serif;
        color: rgba(255, 255, 255, 0.85);
        font-size: 1.15rem;
        line-height: 1.9;
        margin-bottom: 50px;
        font-weight: 300;
        letter-spacing: 0.3px;
    }

    .cdb-btn-solid {
        display: inline-flex;
        align-items: center;
        gap: 15px;
        padding: 18px 45px;
        background: linear-gradient(135deg, #C9A96E 0%, #8B6914 100%);
        color: #0F1F17 !important;
        font-family: 'Inter', sans-serif;
        font-size: 0.95rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 2px;
        text-decoration: none;
        transition: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);
        border: none;
        border-radius: 4px;
        box-shadow: 0 10px 25px rgba(201, 169, 110, 0.3), inset 0 2px 5px rgba(255,255,255,0.3);
        position: relative;
        overflow: hidden;
    }
    
    .cdb-btn-solid::after {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255,255,255,0.4), transparent);
        transition: left 0.6s ease;
    }

    .cdb-btn-solid:hover {
        transform: translateY(-3px);
        box-shadow: 0 15px 35px rgba(201, 169, 110, 0.5), inset 0 2px 5px rgba(255,255,255,0.5);
    }
    
    .cdb-btn-solid:hover::after {
        left: 100%;
    }

    .cdb-btn-icon {
        display: flex;
        align-items: center;
        justify-content: center;
        transition: transform 0.3s ease;
    }

    .cdb-btn-solid:hover .cdb-btn-icon {
        transform: translateX(6px);
    }

    /* 📱 MOBILE RESPONSIVE EXCELLENCE */
    @media (max-width: 1200px) {
        .cdb-title { font-size: 4rem; }
        .cdb-content-half { padding: 60px 40px; }
    }

    @media (max-width: 991px) {
        .cdb-container {
            flex-direction: column;
            min-height: auto;
        }

        .cdb-image-half {
            width: 100%;
            height: 50vh; /* Takes up exactly half screen on mobile */
            min-height: 400px;
            flex: none;
        }

        .cdb-image-overlay {
            background: linear-gradient(180deg, transparent 0%, rgba(15, 31, 23, 0.6) 70%, #0F1F17 100%);
        }

        .cdb-content-half {
            width: 100%;
            padding: 50px 20px;
            text-align: center;
            align-items: center;
            background: #0F1F17;
        }

        .cdb-content-inner {
            display: flex;
            flex-direction: column;
            align-items: center;
            max-width: 100%;
        }

        .cdb-title {
            font-size: 3.2rem;
            br { display: none; }
        }

        .cdb-divider {
            margin: 0 auto 30px auto;
            background: linear-gradient(90deg, transparent, #C9A96E, transparent);
            width: 150px;
        }
        
        .cdb-floating-badge {
            bottom: 30px;
            left: 50%;
            transform: translateX(-50%) !important; /* Centered on mobile */
            padding: 12px 20px;
            width: max-content;
        }
        
        /* Disable badge animation on mobile so it stays centered properly */
        .cdb-floating-badge {
            animation: none;
        }
        
        .cdb-section-visible .cdb-floating-badge {
            opacity: 1;
            transform: translateX(-50%) scale(1) !important;
        }
        .reveal-scale {
            transform: translateX(-50%) scale(0.8) !important; 
        }
    }

    @media (max-width: 576px) {
        .cdb-image-half {
            height: 45vh;
            min-height: 350px;
        }

        .cdb-title {
            font-size: 2.4rem;
            letter-spacing: -0.5px;
        }

        .cdb-subtitle {
            font-size: 0.75rem;
            letter-spacing: 4px;
        }

        .cdb-text {
            font-size: 1rem;
            line-height: 1.7;
            margin-bottom: 40px;
            padding: 0 10px;
        }

        .cdb-btn-solid {
            padding: 16px 24px;
            width: 100%;
            justify-content: center;
            font-size: 0.85rem;
        }
        
        .cdb-floating-badge {
            bottom: 20px;
            padding: 10px 15px;
        }
        
        .cdb-badge-icon {
            font-size: 1.8rem;
        }
        
        .cdb-badge-text span {
            font-size: 0.65rem;
        }
        
        .cdb-badge-text strong {
            font-size: 0.95rem;
        }
    }
</style>

<script>
    // Intersection Observer for scroll animations
    document.addEventListener('DOMContentLoaded', function() {
        const cdbSection = document.getElementById('cdb-section');
        
        if (cdbSection) {
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('cdb-section-visible');
                        // Optional: Unobserve after revealing to animate only once
                        observer.unobserve(entry.target);
                    }
                });
            }, {
                threshold: 0.2 // Trigger when 20% of the section is visible
            });
            
            observer.observe(cdbSection);
        }
    });
</script>
