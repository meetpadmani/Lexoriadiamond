@include('frontend.navbar')

<!-- Google Fonts -->
<link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&family=Playfair+Display:ital,wght@0,400;0,500;0,600;0,700;1,400&display=swap" rel="stylesheet">

<style>
    :root {
        --premium-gold: #b58d55; /* Refined gold for light theme */
        --premium-dark: #FFFFFF; /* Pure White */
        --premium-darker: #fcf9f5; /* Soft ivory/off-white */
        --premium-light: #111111; /* Dark text for light mode */
        --border-gold: rgba(181, 141, 85, 0.2);
    }

    body {
        font-family: 'Outfit', sans-serif;
        background-color: var(--premium-dark);
        color: var(--premium-light);
    }

    /* ===== HERO SECTION ===== */
    .hero-banner {
        position: relative;
        height: 35vh;
        min-height: 250px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: radial-gradient(circle at center, rgba(181, 141, 85, 0.08) 0%, var(--premium-darker) 100%);
        border-bottom: 1px solid var(--border-gold);
        text-align: center;
        overflow: hidden;
    }
    .hero-banner::before {
        content: '';
        position: absolute;
        inset: 0;
        background-image: url("data:image/svg+xml,%3Csvg width='100' height='100' viewBox='0 0 100 100' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M50 0L100 50L50 100L0 50Z' fill='none' stroke='%23b58d55' stroke-opacity='0.05' stroke-width='1'/%3E%3C/svg%3E");
        background-size: 150px;
        z-index: 1;
    }
    .hero-content {
        position: relative;
        z-index: 2;
        max-width: 800px;
        padding: 0 20px;
    }
    .hero-title {
        font-family: 'Playfair Display', serif;
        font-size: clamp(3rem, 6vw, 5.5rem);
        font-weight: 500;
        font-style: italic;
        color: var(--premium-gold);
        margin-bottom: 15px;
        line-height: 1.1;
        letter-spacing: 2px;
    }
    .hero-subtitle {
        font-size: 1.1rem;
        text-transform: uppercase;
        letter-spacing: 6px;
        color: var(--premium-light);
        margin-bottom: 30px;
    }
    .breadcrumb-elegant {
        font-size: 0.75rem;
        text-transform: uppercase;
        letter-spacing: 2px;
        color: rgba(17, 17, 17, 0.6);
    }
    .breadcrumb-elegant a {
        color: inherit;
        text-decoration: none;
        transition: color 0.3s;
    }
    .breadcrumb-elegant a:hover { color: var(--premium-gold); }
    .breadcrumb-elegant span { margin: 0 10px; color: var(--border-gold); }

    /* ===== HORIZONTAL FILTER BAR ===== */
    .filter-bar-wrapper {
        position: sticky;
        top: 0; /* Adjust if navbar is sticky */
        z-index: 100;
        background: rgba(255, 255, 255, 0.85); /* Light glass */
        backdrop-filter: blur(20px);
        -webkit-backdrop-filter: blur(20px);
        border-bottom: 1px solid var(--border-gold);
        padding: 15px 40px;
    }
    .filter-form {
        display: flex;
        flex-wrap: wrap;
        gap: 15px;
        align-items: center;
        justify-content: center;
        max-width: 1440px;
        margin: 0 auto;
    }
    .filter-select {
        background: transparent;
        border: 1px solid rgba(212, 175, 55, 0.4);
        color: var(--premium-light);
        padding: 10px 35px 10px 15px;
        font-family: 'Outfit', sans-serif;
        font-size: 0.85rem;
        border-radius: 30px;
        cursor: pointer;
        appearance: none;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' fill='%23d4af37' class='bi bi-chevron-down' viewBox='0 0 16 16'%3E%3Cpath fill-rule='evenodd' d='M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z'/%3E%3C/svg%3E");
        background-repeat: no-repeat;
        background-position: right 15px center;
        transition: all 0.3s ease;
    }
    .filter-select:hover, .filter-select:focus {
        border-color: var(--premium-gold);
        box-shadow: 0 0 15px rgba(181, 141, 85, 0.15);
        outline: none;
    }
    .filter-select option {
        background: #FFFFFF;
        color: #111111;
    }
    .filter-reset {
        color: var(--premium-gold);
        font-size: 0.8rem;
        text-transform: uppercase;
        letter-spacing: 2px;
        text-decoration: none;
        margin-left: 15px;
        border-bottom: 1px solid transparent;
        transition: border-color 0.3s;
    }
    .filter-reset:hover { border-color: var(--premium-gold); }

    /* ===== PRODUCT GRID ===== */
    .products-container {
        max-width: 1600px;
        margin: 60px auto 100px;
        padding: 0 40px;
    }
    .grid-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 40px;
    }
    .results-count {
        font-size: 0.85rem;
        letter-spacing: 2px;
        text-transform: uppercase;
        color: rgba(17, 17, 17, 0.6);
    }
    
    .masonry-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
        gap: 40px;
    }

    /* ===== EDITORIAL BOUTIQUE PRODUCT CARD ===== */
    .luxury-card {
        display: flex;
        flex-direction: column;
        text-decoration: none;
        background: transparent;
        position: relative;
        group: relative;
    }
    
    .card-image-wrapper {
        position: relative;
        background: #fdfdfd;
        aspect-ratio: 3 / 4;
        border-radius: 4px;
        overflow: hidden;
        margin-bottom: 15px;
    }
    
    .card-image-wrapper img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 1.5s cubic-bezier(0.165, 0.84, 0.44, 1), opacity 0.8s ease;
    }
    
    .card-image-wrapper .hover-img {
        position: absolute;
        inset: 0;
        opacity: 0;
    }
    
    .luxury-card:hover .main-img { opacity: 0; }
    .luxury-card:hover .hover-img { opacity: 1; transform: scale(1.05); }
    .luxury-card:hover img:not(.hover-img) { transform: scale(1.05); }

    /* The Info Below Image */
    .card-info {
        text-align: left;
        padding: 0 5px;
        display: flex;
        flex-direction: column;
    }
    
    .card-meta {
        color: rgba(17, 17, 17, 0.5);
        font-size: 0.65rem;
        text-transform: uppercase;
        letter-spacing: 2px;
        margin-bottom: 6px;
        font-weight: 500;
    }
    
    .card-title {
        font-family: 'Outfit', sans-serif;
        font-size: 1.1rem;
        color: #111111;
        margin: 0 0 6px 0;
        font-weight: 300;
    }
    
    .card-price {
        font-size: 1rem;
        color: #111111;
        font-weight: 500;
        display: flex;
        align-items: center;
        gap: 10px;
    }
    
    .card-price .old {
        text-decoration: line-through;
        color: rgba(17, 17, 17, 0.4);
        font-size: 0.85rem;
        font-weight: 400;
    }

    /* Elegant Hover Actions over Image */
    .card-actions-overlay {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        padding: 15px;
        background: linear-gradient(to top, rgba(255,255,255,0.95) 0%, rgba(255,255,255,0.7) 50%, transparent 100%);
        display: flex;
        justify-content: space-between;
        align-items: center;
        opacity: 0;
        transform: translateY(20px);
        transition: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);
    }
    
    .luxury-card:hover .card-actions-overlay {
        opacity: 1;
        transform: translateY(0);
    }
    
    .action-btn-atc {
        background: #111111;
        color: #FFFFFF;
        border: none;
        padding: 10px 20px;
        font-size: 0.75rem;
        text-transform: uppercase;
        letter-spacing: 1px;
        flex-grow: 1;
        cursor: pointer;
        transition: background 0.3s;
        text-align: center;
        font-family: 'Outfit', sans-serif;
    }
    .action-btn-atc:hover {
        background: var(--premium-gold);
    }
    
    .action-btn-wish {
        background: transparent;
        border: none;
        color: #111111;
        font-size: 1.2rem;
        padding: 10px;
        cursor: pointer;
        transition: color 0.3s;
    }
    .action-btn-wish:hover {
        color: var(--premium-gold);
    }
    
    .badge {
        position: absolute;
        top: 10px;
        left: 10px;
        background: var(--premium-gold);
        color: #FFFFFF;
        padding: 4px 10px;
        font-size: 0.6rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 1px;
        z-index: 10;
    }

    /* ===== PAGINATION ===== */
    .pagination-wrap {
        margin-top: 60px;
        display: flex;
        justify-content: center;
    }

    /* ===== MORE COLLECTIONS ===== */
    .more-collections {
        padding: 100px 40px;
        background: var(--premium-darker);
        border-top: 1px solid var(--border-gold);
    }
    .more-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 30px;
        max-width: 1440px;
        margin: 50px auto 0;
    }
    .more-card {
        text-decoration: none;
        display: block;
        text-align: center;
    }
    .more-img-wrap {
        border-radius: 200px 200px 0 0;
        overflow: hidden;
        aspect-ratio: 3/4;
        margin-bottom: 25px;
        border: 1px solid var(--border-gold);
        position: relative;
    }
    .more-img-wrap img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 1.5s ease;
    }
    .more-card:hover img { transform: scale(1.08); }
    .more-title {
        font-family: 'Playfair Display', serif;
        font-size: 1.5rem;
        color: var(--premium-light);
        margin: 0 0 5px;
        font-style: italic;
    }
    .more-count {
        color: var(--premium-gold);
        font-size: 0.75rem;
        text-transform: uppercase;
        letter-spacing: 2px;
    }

    @media (max-width: 1024px) {
        .masonry-grid { grid-template-columns: repeat(2, 1fr); }
    }
    @media (max-width: 768px) {
        .hero-title { font-size: 2.5rem; }
        .filter-form { flex-direction: column; align-items: stretch; }
        .masonry-grid { grid-template-columns: 1fr; gap: 20px; }
        .products-container, .more-collections { padding-left: 20px; padding-right: 20px; }
        .card-overlay { opacity: 1; transform: none; background: linear-gradient(to top, rgba(8, 17, 12, 0.9) 0%, transparent 60%); }
    }
</style>

<main class="collection-detail-page">
    <!-- HERO SECTION -->
    <section class="hero-banner">
        <div class="hero-content">
            <div class="breadcrumb-elegant">
                <a href="/">Home</a> <span>/</span> 
                <a href="{{ route('collections') }}">Collections</a> <span>/</span> 
                <span style="color: var(--premium-gold)">{{ $collection->title }}</span>
            </div>
            <h1 class="hero-title">{{ $collection->title }}</h1>
            <div class="hero-subtitle">Exquisite Handcrafted Masterpieces</div>
            @if($collection->description)
                <p style="color: rgba(17,17,17,0.7); max-width: 600px; margin: 0 auto; line-height: 1.8;">{{ $collection->description }}</p>
            @endif
        </div>
    </section>

    <!-- HORIZONTAL FILTER BAR -->
    <div class="filter-bar-wrapper">
        <form action="{{ url()->current() }}" method="GET" id="filterForm" class="filter-form">
            <select name="sort" class="filter-select" onchange="this.form.submit()">
                <option value="default" {{ request('sort') == 'default' ? 'selected' : '' }}>Sort: Featured</option>
                <option value="newest" {{ request('sort') == 'newest' ? 'selected' : '' }}>New Arrivals</option>
                <option value="price_low" {{ request('sort') == 'price_low' ? 'selected' : '' }}>Price: Low to High</option>
                <option value="price_high" {{ request('sort') == 'price_high' ? 'selected' : '' }}>Price: High to Low</option>
            </select>

            <select name="metal" class="filter-select" onchange="this.form.submit()">
                <option value="">Metal Type</option>
                @foreach(['Gold', 'White Gold', 'Platinum', 'Silver'] as $metal)
                    <option value="{{ $metal }}" {{ request('metal') == $metal ? 'selected' : '' }}>{{ $metal }}</option>
                @endforeach
            </select>

            <select name="purity" class="filter-select" onchange="this.form.submit()">
                <option value="">Metal Purity</option>
                @foreach(['18KT', '22KT', '24KT', '950 Platinum'] as $purity)
                    <option value="{{ $purity }}" {{ request('purity') == $purity ? 'selected' : '' }}>{{ $purity }}</option>
                @endforeach
            </select>

            <select name="price_range" class="filter-select" onchange="this.form.submit()">
                <option value="">Price Range</option>
                <option value="0-50000" {{ request('price_range') == '0-50000' ? 'selected' : '' }}>Under $50,000</option>
                <option value="50000-150000" {{ request('price_range') == '50000-150000' ? 'selected' : '' }}>$50k — $1.5L</option>
                <option value="150000-500000" {{ request('price_range') == '150000-500000' ? 'selected' : '' }}>$1.5L — $5L</option>
                <option value="500000+" {{ request('price_range') == '500000+' ? 'selected' : '' }}>Above $5L</option>
            </select>

            <select name="style" class="filter-select" onchange="this.form.submit()">
                <option value="">Design Style</option>
                @foreach(['Classic', 'Contemporary', 'Temple Jewelry', 'Antique Finish', 'Filigree'] as $style)
                    <option value="{{ $style }}" {{ request('style') == $style ? 'selected' : '' }}>{{ $style }}</option>
                @endforeach
            </select>

            @if(request()->anyFilled(['sort', 'metal', 'price_range', 'purity', 'availability', 'premium', 'weight_range', 'style']))
                <a href="{{ url()->current() }}" class="filter-reset">Reset Filters</a>
            @endif
        </form>
    </div>

    <!-- PRODUCTS GRID -->
    <div class="products-container">
        <div class="grid-header">
            <h2 style="font-family: 'Playfair Display', serif; font-size: 2rem; margin:0; font-weight: 500; font-style: italic;">The Collection</h2>
            <div class="results-count">Showing {{ $products->count() }} of {{ $products->total() }} pieces</div>
        </div>

        @if($products->count() > 0)
            <div class="masonry-grid">
                @foreach($products as $product)
                    <a href="{{ route('collections.product', [$collection->slug, $product->slug]) }}" class="luxury-card">
                        <div class="card-image-wrapper">
                            @if($product->is_featured)
                                <div class="badge">Featured</div>
                            @endif
                            
                            <img src="{{ str_starts_with($product->image, 'http') ? $product->image : asset($product->image) }}"
                                 alt="{{ $product->name }}" class="main-img">
                            
                            @if($product->image2)
                                <img src="{{ str_starts_with($product->image2, 'http') ? $product->image2 : asset($product->image2) }}"
                                     alt="{{ $product->name }} Hover" class="hover-img">
                            @endif
                            
                            <div class="card-actions-overlay">
                                <form action="{{ route('cart.add') }}" method="POST" class="ajax-atc-form" style="margin:0; flex-grow: 1;">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                    <button type="submit" class="action-btn-atc" title="Add to Cart">Add to Cart</button>
                                </form>
                                <form action="{{ route('wishlist.add') }}" method="POST" class="ajax-wishlist-form" style="margin:0;">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                    <button type="submit" class="action-btn-wish" title="Add to Wishlist"><i class="bi bi-heart"></i></button>
                                </form>
                            </div>
                        </div>

                        <div class="card-info">
                            <div class="card-meta">{{ $product->metal_type }} {{ $product->metal_purity }}</div>
                            <h3 class="card-title">{{ $product->name }}</h3>
                            <div class="card-price">
                                <span>${{ number_format($product->price) }}</span>
                                @if($product->original_price && $product->original_price > $product->price)
                                    <span class="old">${{ number_format($product->original_price) }}</span>
                                @endif
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>

            @if($products->hasPages())
                <div class="pagination-wrap">
                    {{ $products->links() }}
                </div>
            @endif
        @else
            <div style="text-align: center; padding: 100px 0; border: 1px dashed var(--border-gold); border-radius: 20px;">
                <i class="bi bi-gem" style="font-size: 3rem; color: var(--premium-gold); display: block; margin-bottom: 20px;"></i>
                <h3 style="font-family: 'Playfair Display', serif; font-size: 2rem; margin-bottom: 10px; color: var(--premium-light);">Masterpieces Coming Soon</h3>
                <p style="color: rgba(17,17,17,0.6);">Our artisans are currently curating exquisite pieces for this collection.</p>
            </div>
        @endif
    </div>

    <!-- MORE COLLECTIONS -->
    @if($otherCollections->count() > 0)
        <section class="more-collections">
            <div style="text-align: center;">
                <span style="font-size: 0.8rem; text-transform: uppercase; letter-spacing: 5px; color: var(--premium-gold); display: block; margin-bottom: 10px;">Discover</span>
                <h2 style="font-family: 'Playfair Display', serif; font-size: 2.8rem; color: var(--premium-light); margin: 0; font-style: italic;">More Collections</h2>
            </div>

            <div class="more-grid">
                @foreach($otherCollections as $otherCol)
                    <a href="{{ route('collections.show', $otherCol->slug) }}" class="more-card">
                        <div class="more-img-wrap">
                            <img src="{{ str_starts_with($otherCol->image, 'http') ? $otherCol->image : asset($otherCol->image) }}" alt="{{ $otherCol->title }}">
                        </div>
                        <h3 class="more-title">{{ $otherCol->title }}</h3>
                        <div class="more-count">{{ $otherCol->products_count }} Pieces</div>
                    </a>
                @endforeach
            </div>
        </section>
    @endif
</main>

@include('frontend.footer')
