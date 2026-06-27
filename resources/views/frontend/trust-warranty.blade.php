<section class="lexoria-promise-section">
    <div class="promise-bg-glow"></div>
    
    <div class="container promise-container">
        <div class="promise-header text-center">
            <span class="promise-subtitle">Commitment to Excellence</span>
            <h2 class="promise-title">The Lexoria Promise</h2>
            <div class="title-separator">
                <div class="line"></div>
                <div class="diamond"></div>
                <div class="line"></div>
            </div>
        </div>

        <div class="promise-grid">
            <!-- Lifetime Warranty -->
            <div class="promise-card">
                <div class="promise-icon-wrapper">
                    <svg class="promise-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                    </svg>
                    <div class="icon-glow"></div>
                </div>
                <h3 class="card-title">Lifetime Warranty</h3>
                <p class="card-text">Every piece is protected by our comprehensive lifetime warranty against manufacturing defects.</p>
            </div>

            <!-- Certified Diamonds -->
            <div class="promise-card">
                <div class="promise-icon-wrapper">
                    <svg class="promise-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z" />
                    </svg>
                    <div class="icon-glow"></div>
                </div>
                <h3 class="card-title">100% Certified</h3>
                <p class="card-text">Our diamonds are ethically sourced and certified by world-renowned laboratories like IGI & GIA.</p>
            </div>

            <!-- Insured Shipping -->
            <div class="promise-card">
                <div class="promise-icon-wrapper">
                    <svg class="promise-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                    </svg>
                    <div class="icon-glow"></div>
                </div>
                <h3 class="card-title">Secure & Insured</h3>
                <p class="card-text">Enjoy peace of mind with our complimentary, fully insured shipping on every order worldwide.</p>
            </div>

            <!-- Easy Returns -->
            <div class="promise-card">
                <div class="promise-icon-wrapper">
                    <svg class="promise-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                    </svg>
                    <div class="icon-glow"></div>
                </div>
                <h3 class="card-title">15-Day Returns</h3>
                <p class="card-text">Not completely in love? We offer a hassle-free 15-day return or exchange policy.</p>
            </div>
        </div>
    </div>
</section>

<style>
    @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&family=Playfair+Display:ital,wght@0,400;0,600;1,400&display=swap');

    .lexoria-promise-section {
        background-color: #0F1F17; /* Dark Forest Green / Mahogany */
        padding: 100px 0;
        position: relative;
        overflow: hidden;
        color: #ffffff;
    }

    .promise-bg-glow {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        width: 80%;
        height: 80%;
        background: radial-gradient(ellipse at center, rgba(201, 169, 110, 0.08) 0%, transparent 70%);
        pointer-events: none;
        z-index: 0;
    }

    .promise-container {
        position: relative;
        z-index: 1;
        max-width: 1300px;
        margin: 0 auto;
        padding: 0 20px;
    }

    .promise-header {
        margin-bottom: 70px;
        text-align: center;
    }

    .promise-subtitle {
        font-family: 'Inter', sans-serif;
        font-size: 0.75rem;
        text-transform: uppercase;
        letter-spacing: 4px;
        color: #C9A96E; /* Brand Gold */
        display: block;
        margin-bottom: 15px;
    }

    .promise-title {
        font-family: 'Playfair Display', serif;
        font-size: 3rem;
        font-weight: 400;
        margin-bottom: 20px;
        color: #ffffff;
    }

    .title-separator {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 15px;
    }

    .title-separator .line {
        height: 1px;
        width: 40px;
        background: linear-gradient(90deg, transparent, #C9A96E, transparent);
    }

    .title-separator .diamond {
        width: 6px;
        height: 6px;
        background-color: #C9A96E;
        transform: rotate(45deg);
    }

    .promise-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 40px;
    }

    .promise-card {
        background: rgba(255, 255, 255, 0.02);
        border: 1px solid rgba(201, 169, 110, 0.15);
        padding: 50px 30px;
        text-align: center;
        border-radius: 2px;
        transition: all 0.5s cubic-bezier(0.165, 0.84, 0.44, 1);
        position: relative;
        overflow: hidden;
    }

    /* Shimmer Effect on Hover */
    .promise-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 50%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(201, 169, 110, 0.1), transparent);
        transform: skewX(-25deg);
        transition: 0.7s;
        z-index: 1;
    }

    .promise-card:hover {
        transform: translateY(-10px);
        background: rgba(201, 169, 110, 0.05);
        border-color: rgba(201, 169, 110, 0.4);
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.5);
    }

    .promise-card:hover::before {
        left: 150%;
    }

    .promise-icon-wrapper {
        position: relative;
        width: 60px;
        height: 60px;
        margin: 0 auto 30px auto;
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 2;
    }

    .promise-icon {
        width: 40px;
        height: 40px;
        color: #C9A96E;
        transition: transform 0.5s ease;
    }

    .promise-card:hover .promise-icon {
        transform: scale(1.1);
    }

    .icon-glow {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        width: 100%;
        height: 100%;
        background: radial-gradient(circle, rgba(201, 169, 110, 0.4) 0%, transparent 70%);
        opacity: 0;
        transition: opacity 0.5s ease;
        z-index: -1;
    }

    .promise-card:hover .icon-glow {
        opacity: 1;
    }

    .card-title {
        font-family: 'Playfair Display', serif;
        font-size: 1.4rem;
        margin-bottom: 15px;
        color: #ffffff;
        font-weight: 400;
    }

    .card-text {
        font-family: 'Inter', sans-serif;
        font-size: 0.9rem;
        line-height: 1.7;
        color: rgba(255, 255, 255, 0.7);
        margin: 0;
    }

    /* Responsive */
    @media (max-width: 1024px) {
        .promise-grid {
            grid-template-columns: repeat(2, 1fr);
            gap: 30px;
        }
    }

    @media (max-width: 768px) {
        .lexoria-promise-section {
            padding: 70px 0;
        }
        
        .promise-title {
            font-size: 2.2rem;
        }

        .promise-grid {
            grid-template-columns: 1fr;
            gap: 20px;
        }

        .promise-card {
            padding: 40px 20px;
        }
    }
</style>
