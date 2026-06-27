<!-- Rajwadi Fort Jharokha Collection Showcase -->
<section class="rajwadi-fort-section">
    <!-- Intricate Jali background overlay -->
    <div class="fort-bg-pattern"></div>
    
    <div class="lux-header">
        <h2 class="lux-title">Meet's Collection</h2>
        <div class="lux-motif">
            <!-- Ornate Palace Lotus Crest -->
            <svg width="80" height="40" viewBox="0 0 100 50" fill="none" stroke="#000000" stroke-width="2">
                <path d="M50 5 C60 20 70 20 90 10 C80 30 70 40 50 45 C30 40 20 30 10 10 C30 20 40 20 50 5 Z" fill="rgba(0, 0, 0, 0.2)"/>
                <circle cx="50" cy="25" r="5" fill="#333333" stroke="none" />
                <path d="M35 25 Q50 15 65 25" stroke="#333333" />
            </svg>
        </div>
        <p class="lux-subtitle">The Royal Collection</p>
    </div>

    <div class="lux-grid">
        @foreach($collections->take(6) as $index => $col)
            <a href="{{ route('collections.show', $col->slug) }}" class="lux-card lux-card-{{ $index }}">
                <div class="lux-img-frame">
                    <img src="{{ str_starts_with($col->image, 'http') ? $col->image : asset($col->image) }}" alt="{{ $col->title }}">
                    <div class="lux-hover-shimmer"></div>
                </div>
                <div class="lux-text-base">
                    <h3>{{ $col->title }}</h3>
                    <span class="lux-explore">View Collection</span>
                </div>
            </a>
        @endforeach
    </div>
</section>

<style>
    .rajwadi-fort-section {
        padding: 90px 0 110px 0;
        background-color: #ffffff; /* Sandstone / Marble warm base */
        background-image: 
            radial-gradient(ellipse at top left, rgba(0, 0, 0, 0.1) 0%, transparent 60%),
            radial-gradient(ellipse at bottom right, rgba(90, 25, 25, 0.1) 0%, transparent 50%);
        position: relative;
        overflow: hidden;
    }

    /* Royal Jali Pattern Overlay */
    .fort-bg-pattern {
        position: absolute;
        inset: 0;
        background-image: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M30 0L60 30L30 60L0 30Z' fill='none' stroke='%235a1919' stroke-opacity='0.04' stroke-width='1'/%3E%3Ccircle cx='30' cy='30' r='10' fill='none' stroke='%23b58d55' stroke-opacity='0.1' stroke-width='1'/%3E%3C/svg%3E");
        z-index: 0;
    }
    
    /* Double heritage border on section */
    .fort-bg-pattern::after {
        content: '';
        position: absolute;
        inset: 20px;
        border: 2px solid rgba(0, 0, 0, 0.5); /* Antique gold */
        outline: 1px solid rgba(0, 0, 0, 0.3);
        outline-offset: -8px;
        pointer-events: none;
    }

    .lux-header {
        text-align: center;
        margin-bottom: 60px;
        position: relative;
        z-index: 1;
    }

    .lux-title {
        font-family: 'Inter', serif;
        font-size: 3.4rem;
        color: #000000; /* Heavy Fort Velvet Red */
        margin-bottom: 15px;
        font-weight: 600;
        letter-spacing: 1.5px;
        text-shadow: 2px 2px 5px rgba(90, 25, 25, 0.15); /* Heritage depth */
    }

    .lux-motif {
        margin-bottom: 15px;
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 20px;
    }

    .lux-motif::before, .lux-motif::after {
        content: '';
        height: 3px;
        width: 140px;
        background: linear-gradient(90deg, transparent, #333333, transparent);
        border-radius: 5px;
    }

    .lux-subtitle {
        font-family: var(--body-font, 'Inter', sans-serif);
        color: #C9A96E; /* Burnished gold */
        letter-spacing: 5px;
        text-transform: uppercase;
        font-size: 0.85rem;
        font-weight: 600;
    }

    /* Make grid into a single row of 6 windows (Full Width) */
    .lux-grid {
        display: grid;
        grid-template-columns: repeat(6, 1fr);
        grid-auto-rows: 450px; /* Increased height by 20% */
        gap: 1.5vw; /* Fluid gap to fit screens */
        max-width: 100%; /* Full screen colonnade */
        margin: 0 auto;
        padding: 0 2vw; /* Slight edge padding */
        position: relative;
        z-index: 1;
    }

    /* Heavy Fort Wall Cards */
    .lux-card {
        position: relative;
        display: block;
        text-decoration: none;
        background: #000000; /* Massive red sandstone/velvet structure */
        border: 4px solid #333333; /* Gold edging */
        padding: 10px 10px 80px 10px; /* Thick walls, space for marble plaque base */
        box-shadow: 
            inset 0 0 20px rgba(0,0,0,0.5), /* Deep carved shadow inside */
            0 15px 30px rgba(0,0,0,0.15); /* shadow on the wall */
        transition: all 0.5s cubic-bezier(0.19, 1, 0.22, 1);
        
        /* Uniform single-row arches */
        grid-column: span 1 !important;
        grid-row: span 1 !important;
        border-radius: 9999px 9999px 0 0 !important;
    }

    /* The 'Window' view */
    .lux-img-frame {
        width: 100%;
        height: 100%;
        border-radius: inherit; /* Inherits whatever dome structure the card has */
        border-bottom-left-radius: 0;
        border-bottom-right-radius: 0;
        overflow: hidden;
        position: relative;
        z-index: 1;
        border: 2px solid #333333; /* Inner window gold rim */
    }

    .lux-img-frame img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 1.5s ease;
        filter: contrast(1.1) brightness(0.9); /* Vintage rich contrast */
    }

    .lux-card:hover {
        transform: translateY(-8px);
        box-shadow: inset 0 0 20px rgba(0,0,0,0.6), 0 20px 45px rgba(90, 25, 25, 0.3);
    }
    
    .lux-card:hover .lux-img-frame img {
        transform: scale(1.1);
        filter: contrast(1.1) brightness(1.05);
    }

    .lux-hover-shimmer {
        position: absolute;
        inset: 0;
        background: linear-gradient(135deg, rgba(255,255,255,0) 0%, rgba(255,255,255,0.1) 50%, rgba(255,255,255,0) 100%);
        transform: translateX(-100%);
        transition: transform 0.8s;
        z-index: 2;
    }

    .lux-card:hover .lux-hover-shimmer {
        transform: translateX(100%);
    }

    /* Marble Plaque at base of Jharokha */
    .lux-text-base {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        height: 80px; /* Compacted height */
        background: #ffffff; /* Sandstone marble floor */
        border-top: 3px solid #333333;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        z-index: 3;
        transition: background 0.4s ease;
    }
    
    .lux-text-base::before {
        content: '';
        position: absolute;
        inset: 4px;
        border: 1px dashed rgba(0, 0, 0, 0.7);
        pointer-events: none;
    }

    .lux-text-base h3 {
        font-family: 'Inter', serif;
        font-size: 1rem; /* Scaled down for thinner single row windows */
        color: #000000;
        margin: 0 0 5px 0;
        font-weight: 600;
        letter-spacing: 1px;
    }

    .lux-explore {
        font-family: var(--body-font, 'Inter', sans-serif);
        font-size: 0.65rem;
        text-transform: uppercase;
        letter-spacing: 2px;
        color: #C9A96E;
        font-weight: 500;
        position: relative;
    }

    /* Small dot motifs */
    .lux-explore::before, .lux-explore::after {
        content: '•';
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        font-size: 0.8rem;
        color: #000000;
    }
    .lux-explore::before { left: -10px; }
    .lux-explore::after { right: -10px; }

    .lux-card:hover .lux-text-base {
        background: #fff;
    }

    /* Responsive */
    @media (max-width: 1200px) {
        .lux-grid {
            grid-template-columns: repeat(3, 1fr);
            gap: 25px;
        }
    }

    @media (max-width: 768px) {
        .fort-bg-pattern::after {
            display: none;
        }
        .rajwadi-fort-section { 
            padding: 60px 15px; 
        }
        .lux-header {
            margin-bottom: 40px;
        }
        .lux-title { 
            font-size: 2.2rem; 
            line-height: 1.2;
        }
        .lux-subtitle {
            font-size: 0.75rem;
            letter-spacing: 4px;
        }
        
        .lux-grid {
            grid-template-columns: repeat(2, 1fr);
            grid-auto-rows: 335px; /* Increased height by 20% */
            gap: 15px;
            padding: 0 5px;
        }
        
        .lux-card { 
            padding: 8px 8px 60px 8px; 
            border-radius: 9999px 9999px 0 0 !important;
            border-width: 3px;
        }

        .lux-text-base {
            height: 60px;
        }

        .lux-text-base h3 {
            font-size: 0.9rem;
            margin-bottom: 2px;
        }

        .lux-explore {
            font-size: 0.6rem;
            letter-spacing: 1.5px;
        }

        .lux-motif::before, .lux-motif::after {
            width: 50px;
        }
        .lux-motif svg {
            width: 60px;
        }
    }

    @media (max-width: 480px) {
        .lux-title { font-size: 1.8rem; }
        .lux-grid {
            grid-auto-rows: 290px;
            gap: 12px;
        }
        .lux-card {
            border-radius: 9999px 9999px 0 0 !important;
        }
    }
</style>


