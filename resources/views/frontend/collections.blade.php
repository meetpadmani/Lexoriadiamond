@include('frontend.navbar')

<style>
    @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,600;1,400&family=Inter:wght@300;400;500;600&display=swap');

    :root {
        --raj-red: #000000;
        --raj-red-dark: #0a1c0f;
        --raj-gold: #333333;
        --raj-gold-light: #d4af37;
        --raj-sand: #ffffff;
        --font-heading: 'Inter', serif;
        --font-body: 'Inter', sans-serif;
        --transition-slow: all 0.8s cubic-bezier(0.25, 1, 0.5, 1);
    }

    body {
        margin: 0;
        background-color: var(--raj-sand);
        background-image: 
            radial-gradient(ellipse at top right, rgba(0, 0, 0, 0.15) 0%, transparent 60%),
            radial-gradient(ellipse at bottom left, rgba(90, 25, 25, 0.1) 0%, transparent 50%);
    }

    /* Royal Jali Pattern Background overlay */
    .page-bg-pattern {
        position: fixed;
        inset: 0;
        background-image: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M30 0L60 30L30 60L0 30Z' fill='none' stroke='%235a1919' stroke-opacity='0.03' stroke-width='1'/%3E%3Ccircle cx='30' cy='30' r='10' fill='none' stroke='%23b58d55' stroke-opacity='0.06' stroke-width='1'/%3E%3C/svg%3E");
        z-index: -1;
        pointer-events: none;
    }

    .collections-container {
        padding: 50px 2vw 100px;
        max-width: 100%;
        margin: 0 auto;
        position: relative;
    }

    /* Royal Header */
    .rajwadi-header {
        text-align: center;
        margin-bottom: 70px;
    }

    .rajwadi-header .sub-text {
        font-family: var(--font-body);
        font-size: 0.85rem;
        text-transform: uppercase;
        letter-spacing: 6px;
        color: var(--raj-gold);
        margin-bottom: 15px;
        display: block;
        font-weight: 500;
    }

    .rajwadi-header h1 {
        font-family: var(--font-heading);
        font-size: clamp(3rem, 6vw, 4.5rem);
        margin: 0;
        font-weight: 600;
        color: var(--raj-red);
        text-shadow: 2px 2px 10px rgba(90, 25, 25, 0.1);
    }

    .rajwadi-motif {
        margin: 20px auto;
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 20px;
    }

    .rajwadi-motif::before, .rajwadi-motif::after {
        content: '';
        height: 2px;
        width: 100px;
        background: linear-gradient(90deg, transparent, var(--raj-gold), transparent);
    }



    .jharokha-card {
        position: relative;
        background: var(--raj-red);
        border: 3px solid var(--raj-gold);
        padding: 12px 12px 90px 12px;
        border-radius: 180px 180px 0 0;
        text-decoration: none;
        box-shadow: 
            inset 0 0 30px rgba(0,0,0,0.6), 
            0 20px 40px rgba(90, 25, 25, 0.2);
        transition: var(--transition-slow);
        display: block;
    }

    .jharokha-card:hover {
        transform: translateY(-15px);
        box-shadow: 
            inset 0 0 40px rgba(0,0,0,0.8), 
            0 30px 50px rgba(90, 25, 25, 0.4);
        border-color: var(--raj-gold-light);
    }

    .jharokha-img-frame {
        width: 100%;
        height: 480px;
        border-radius: 170px 170px 0 0;
        overflow: hidden;
        border: 2px solid var(--raj-gold);
        position: relative;
    }

    .jharokha-img-frame img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: var(--transition-slow);
        filter: brightness(0.9) contrast(1.1);
    }

    .jharokha-card:hover .jharokha-img-frame img {
        transform: scale(1.1);
        filter: brightness(1) contrast(1.15);
    }

    .jharokha-text {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        height: 90px;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
    }

    .jharokha-text h3 {
        font-family: var(--font-heading);
        color: #fff;
        margin: 0 0 5px 0;
        font-size: 1.6rem;
        font-weight: 500;
        letter-spacing: 1px;
    }

    .jharokha-text span {
        font-family: var(--font-body);
        color: var(--raj-gold);
        font-size: 0.7rem;
        text-transform: uppercase;
        letter-spacing: 3px;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .jharokha-text span::after {
        content: '\2192';
        font-style: normal;
        transition: transform 0.3s ease;
    }

    .jharokha-card:hover .jharokha-text span::after {
        transform: translateX(5px);
    }

    /* Knowledge Academy - Royal Court */
    .academy-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 30px;
    }

    .court-card {
        background: transparent;
        border: 1px solid rgba(0, 0, 0, 0.4);
        padding: 50px 30px;
        text-align: center;
        text-decoration: none;
        transition: var(--transition-slow);
        position: relative;
        overflow: hidden;
    }

    .court-card::before {
        content: '';
        position: absolute;
        inset: 5px;
        border: 1px solid rgba(0, 0, 0, 0.2);
        pointer-events: none;
        transition: all 0.5s ease;
    }

    .court-card:hover {
        background: var(--raj-red);
        border-color: var(--raj-gold);
        box-shadow: 0 15px 35px rgba(90, 25, 25, 0.2);
        transform: translateY(-8px);
    }

    .court-card:hover::before {
        border-color: rgba(0, 0, 0, 0.6);
        inset: 8px;
    }

    .court-icon {
        font-size: 2.8rem;
        color: var(--raj-gold);
        margin-bottom: 20px;
        display: block;
        transition: transform 0.5s ease;
    }

    .court-card:hover .court-icon {
        transform: scale(1.1) rotate(5deg);
        color: var(--raj-gold-light);
    }

    .court-card h3 {
        font-family: var(--font-heading);
        font-size: 1.6rem;
        color: var(--raj-red);
        margin: 0 0 10px 0;
        transition: color 0.5s ease;
    }

    .court-card:hover h3 {
        color: #fff;
    }

    .court-card p {
        font-family: var(--font-body);
        font-size: 0.75rem;
        text-transform: uppercase;
        letter-spacing: 2px;
        color: #777;
        margin: 0;
        transition: color 0.5s ease;
    }

    .court-card:hover p {
        color: var(--raj-gold);
    }

    .jharokha-grid {
        display: grid;
        grid-template-columns: repeat(6, 1fr);
        gap: 1.5vw;
        margin-bottom: 120px;
        max-width: 100%;
        overflow-x: auto;
        padding-bottom: 20px;
    }

    /* Scrollbar styling for horizontal scroll on smaller screens */
    .jharokha-grid::-webkit-scrollbar {
        height: 6px;
    }
    .jharokha-grid::-webkit-scrollbar-track {
        background: rgba(0, 0, 0, 0.1);
        border-radius: 10px;
    }
    .jharokha-grid::-webkit-scrollbar-thumb {
        background: rgba(0, 0, 0, 0.5);
        border-radius: 10px;
    }

    @media (max-width: 1200px) {
        .jharokha-grid {
            grid-template-columns: repeat(4, 1fr);
            overflow-x: visible;
        }
    }

    @media (max-width: 1024px) {
        .academy-grid { grid-template-columns: repeat(2, 1fr); }
    }

    @media (max-width: 768px) {
        .collections-container {
            padding: 40px 15px 80px;
        }

        .rajwadi-header {
            margin-bottom: 40px;
        }

        .rajwadi-header h1 {
            font-size: 2.5rem;
        }

        .rajwadi-header .sub-text {
            letter-spacing: 3px;
            font-size: 0.75rem;
        }

        .jharokha-grid {
            grid-template-columns: repeat(2, 1fr);
            gap: 15px;
            margin-bottom: 80px;
            overflow-x: visible;
        }

        .jharokha-card {
            padding: 8px 8px 60px 8px;
            border-radius: 120px 120px 0 0;
            border-width: 2px;
        }

        .jharokha-img-frame {
            height: 250px;
            border-radius: 112px 112px 0 0;
        }

        .jharokha-text {
            height: 60px;
        }

        .jharokha-text h3 {
            font-size: 1.1rem;
        }

        .jharokha-text span {
            font-size: 0.6rem;
            letter-spacing: 1px;
        }

        .academy-grid { 
            grid-template-columns: 1fr; 
            gap: 15px;
        }

        .court-card {
            padding: 35px 20px;
        }

        .court-card h3 {
            font-size: 1.4rem;
        }

        .rajwadi-header[style*="margin-top: 150px"] {
            margin-top: 80px !important;
        }
    }

</style>

<div class="page-bg-pattern"></div>

<main class="collections-container">
    
    <header class="rajwadi-header">
        <span class="sub-text">Lexoria Diamond Store</span>
        <h1>Our Collections</h1>
        <div class="rajwadi-motif">
            <svg width="40" height="40" viewBox="0 0 100 100" fill="none">
                <path d="M50 10 L60 40 L90 50 L60 60 L50 90 L40 60 L10 50 L40 40 Z" fill="#333333"/>
            </svg>
        </div>
    </header>

    <div class="jharokha-grid">
        @foreach($collections as $collection)
            <a href="{{ route('collections.show', $collection->slug) }}" class="jharokha-card">
                <div class="jharokha-img-frame">
                    <img src="{{ str_starts_with($collection->image, 'http') ? $collection->image : asset($collection->image) }}" 
                         alt="{{ $collection->title }}">
                </div>
                <div class="jharokha-text">
                    <h3>{{ $collection->title }}</h3>
                    <span>View Collection</span>
                </div>
            </a>
        @endforeach
    </div>

    <!-- Redesigned Knowledge Section -->
    <header class="rajwadi-header" style="margin-top: 150px;">
        <span class="sub-text">Diamond Education</span>
        <h2>Diamond Shapes & Guide</h2>
        <div class="rajwadi-motif">
            <svg width="40" height="40" viewBox="0 0 100 100" fill="none">
                <path d="M50 10 L60 40 L90 50 L60 60 L50 90 L40 60 L10 50 L40 40 Z" fill="#333333"/>
            </svg>
        </div>
    </header>

    <div class="academy-grid">
        <a href="#" class="court-card">
            <i class="bi bi-octagon court-icon"></i>
            <h3>Round Brilliant</h3>
            <p>Timeless Classic Cut</p>
        </a>
        <a href="#" class="court-card">
            <i class="bi bi-pentagon court-icon"></i>
            <h3>Emerald Cut</h3>
            <p>Vintage Sophistication</p>
        </a>
        <a href="#" class="court-card">
            <i class="bi bi-suit-heart court-icon"></i>
            <h3>Heart Shape</h3>
            <p>The Ultimate Symbol</p>
        </a>
        <a href="#" class="court-card">
            <i class="bi bi-journal-text court-icon"></i>
            <h3>Diamond Guide</h3>
            <p>Mastering the 4C's</p>
        </a>
        <a href="#" class="court-card">
            <i class="bi bi-shield-check court-icon"></i>
            <h3>Ethical Safety</h3>
            <p>IGI & GIA Certified</p>
        </a>
        <a href="#" class="court-card">
            <i class="bi bi-brush court-icon"></i>
            <h3>Jewellery Care</h3>
            <p>Everlasting Shine</p>
        </a>
    </div>

</main>

@include('frontend.footer')


