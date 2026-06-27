@include('frontend.navbar')

<!-- Google Fonts -->
<link
    href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&family=Playfair+Display:ital,wght@0,400;0,500;0,600;0,700;1,400&display=swap"
    rel="stylesheet">

<style>
    :root {
        --premium-gold: #333333;
        --premium-dark: #000000;
        --premium-grey: #8a735a;
        --premium-light: #ffffff;
        --text-main: #3a1515;
        --border-color: rgba(0, 0, 0, 0.3);
    }

    body {
        font-family: 'Outfit', sans-serif;
        color: var(--premium-light);
        background-color: var(--premium-dark);
    }

    .products-page {
        padding-top: 0;
        background-color: var(--premium-dark);
        background-image:
            radial-gradient(circle at 100% 0%, rgba(0, 0, 0, 0.15) 0%, transparent 50%),
            url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M30 0L60 30L30 60L0 30Z' fill='none' stroke='%23b58d55' stroke-opacity='0.1' stroke-width='1'/%3E%3C/svg%3E");
    }

    /* ===== BREADCRUMB ===== */
    .breadcrumb-bar {
        max-width: 100%;
        margin: 0;
        padding: 30px 40px;
        font-size: 0.75rem;
        text-transform: uppercase;
        letter-spacing: 1.5px;
        color: var(--premium-grey);
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .breadcrumb-bar a {
        color: inherit;
        text-decoration: none;
        transition: color 0.3s ease;
    }

    .breadcrumb-bar a:hover {
        color: var(--premium-gold);
    }

    .breadcrumb-bar span.separator {
        color: rgba(0, 0, 0, 0.4);
    }

    /* ===== HERO BANNER ===== */
    .products-hero {
        position: relative;
        height: 35vh;
        min-height: 300px;
        overflow: hidden;
        display: flex;
        align-items: center;
        justify-content: center;
        background-color: var(--premium-dark);
        margin-bottom: 60px;
        border-bottom: 4px solid var(--premium-gold);
    }

    .products-hero-content {
        position: relative;
        z-index: 2;
        text-align: center;
        color: #fff;
        max-width: 800px;
        padding: 0 20px;
    }

    .products-hero-label {
        font-size: 0.8rem;
        text-transform: uppercase;
        letter-spacing: 5px;
        color: var(--premium-gold);
        margin-bottom: 20px;
    }

    .products-hero-title {
        font-family: 'Inter', serif;
        font-size: clamp(2.5rem, 5vw, 4rem);
        font-weight: 700;
        margin-bottom: 20px;
        letter-spacing: -1px;
        line-height: 1.1;
        color: var(--premium-light);
    }

    /* ===== PRODUCTS SECTION ===== */
    .products-section {
        max-width: 1440px;
        margin: 0 auto;
        padding: 0 40px 100px;
    }

    .section-header {
        display: flex;
        justify-content: space-between;
        align-items: flex-end;
        margin-bottom: 50px;
        padding-bottom: 20px;
        border-bottom: 1px solid var(--border-color);
    }

    .section-header h2 {
        font-family: 'Inter', serif;
        font-size: 2.2rem;
        margin: 0;
        color: var(--premium-light);
    }

    .results-count {
        font-size: 0.8rem;
        color: #fff;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    .products-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
        gap: 30px;
    }

    /* ===== PRODUCT CARD ===== */
    .product-card {
        text-decoration: none;
        color: inherit;
        display: block;
        transition: transform 0.4s ease;
    }

    .product-image-wrap {
        position: relative;
        aspect-ratio: 1/1.2;
        background-color: #fff;
        border: 1px solid var(--border-color);
        margin-bottom: 20px;
        overflow: hidden;
    }

    .product-image-wrap img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 1.2s ease, opacity 0.5s ease;
    }

    .hover-img {
        position: absolute;
        top: 0;
        left: 0;
        opacity: 0;
    }

    .product-card:hover .main-img {
        opacity: 0;
        transform: scale(1.05);
    }

    .product-card:hover .hover-img {
        opacity: 1;
        transform: scale(1.05);
    }

    .product-card:hover .product-image-wrap:not(.has-hover) .main-img {
        opacity: 1;
    }

    .badge-premium {
        position: absolute;
        top: 10px;
        left: 10px;
        background: #e9d7c3;
        color: #7d6348;
        padding: 4px 8px;
        font-size: 0.6rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 1px;
        z-index: 2;
    }

    .badge-sale {
        top: 35px;
        background: #ff4d4d;
        color: #fff;
    }

    .badge-digital {
        top: auto;
        bottom: 10px;
        left: 10px;
        background: #111;
        color: #c9a96e;
        border: 1px solid #c9a96e;
        box-shadow: 0 4px 10px rgba(0,0,0,0.5);
    }

    .card-actions {
        position: absolute;
        top: 15px;
        right: 15px;
        display: flex;
        flex-direction: column;
        gap: 10px;
        opacity: 0;
        transform: translateX(10px);
        transition: all 0.3s ease;
        z-index: 5;
    }

    .product-card:hover .card-actions {
        opacity: 1;
        transform: translateX(0);
    }

    .card-action-btn {
        width: 35px;
        height: 35px;
        background: #fff;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--premium-dark);
        border: 1px solid var(--premium-gold);
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        cursor: pointer;
        transition: all 0.3s ease;
        padding: 0;
    }

    .card-action-btn:hover {
        background: var(--premium-dark);
        color: #fff;
    }

    .product-info {
        text-align: center;
    }

    .product-meta {
        font-size: 0.7rem;
        text-transform: uppercase;
        letter-spacing: 2px;
        color: var(--premium-gold);
        margin-bottom: 8px;
    }

    .product-name {
        font-family: 'Inter', serif;
        font-size: 1.2rem;
        font-weight: 500;
        margin-bottom: 10px;
        color: var(--premium-light);
    }

    .product-price {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 12px;
    }

    .curr-price {
        font-weight: 600;
        color: var(--premium-gold);
    }

    .old-price {
        color: rgba(247, 239, 230, 0.5);
        text-decoration: line-through;
        font-size: 0.9rem;
    }

    /* ===== SIDEBAR FILTER DESIGN ===== */
    .collection-container {
        display: flex;
        gap: 40px;
        width: 100%;
        max-width: 100%;
        margin: 0;
        padding: 0 40px 100px;
    }

    .sidebar-filters {
        width: 300px;
        flex-shrink: 0;
    }

    .filter-card-rajwadi {
        background: rgba(255, 255, 255, 0.03);
        border: 1px solid var(--border-color);
        padding: 0;
        position: sticky;
        top: 120px;
        z-index: 100;
        max-height: calc(100vh - 160px);
        overflow-y: auto;
        scrollbar-width: thin;
        scrollbar-color: var(--premium-gold) transparent;
    }

    .filter-card-rajwadi::-webkit-scrollbar {
        width: 4px;
    }

    .filter-card-rajwadi::-webkit-scrollbar-thumb {
        background: var(--premium-gold);
        border-radius: 10px;
    }

    .filter-accordion-item {
        border-bottom: 1px solid var(--border-color);
    }

    .filter-accordion-item:last-child {
        border-bottom: none;
    }

    .filter-header {
        width: 100%;
        padding: 20px 25px;
        background: transparent;
        display: flex;
        justify-content: space-between;
        align-items: center;
        cursor: pointer;
        transition: background 0.3s ease;
    }

    .filter-header:hover {
        background: rgba(0, 0, 0, 0.05);
    }

    .filter-header span {
        font-family: 'Inter', serif;
        font-weight: 700;
        color: var(--premium-gold);
        font-size: 0.9rem;
        letter-spacing: 1px;
        text-transform: uppercase;
    }

    .filter-content {
        padding: 0 25px 25px;
        display: block; 
    }

    .premium-input-select {
        width: 100%;
        background: var(--premium-dark);
        border: 1px solid rgba(0, 0, 0, 0.3);
        color: #fff;
        padding: 12px 15px;
        font-family: 'Outfit', sans-serif;
        font-size: 0.8rem;
        border-radius: 0;
        cursor: pointer;
        transition: all 0.3s ease;
        appearance: none;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='%23b58d55' class='bi bi-chevron-down' viewBox='0 0 16 16'%3E%3Cpath fill-rule='evenodd' d='M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z'/%3E%3C/svg%3E");
        background-repeat: no-repeat;
        background-position: right 15px center;
    }

    .raj-checkbox {
        display: flex;
        align-items: center;
        gap: 12px;
        cursor: pointer;
        font-size: 0.85rem;
        color: rgba(255, 255, 255, 0.8);
        transition: all 0.3s ease;
        margin-bottom: 12px;
    }

    .custom-box {
        width: 18px;
        height: 18px;
        border: 1px solid var(--premium-gold);
        position: relative;
        transition: all 0.3s ease;
    }

    .raj-checkbox input:checked + .custom-box {
        background: var(--premium-gold);
    }

    .clear-raj {
        text-align: center;
        padding: 20px;
        font-size: 0.7rem;
        color: var(--premium-grey);
        text-decoration: none;
        text-transform: uppercase;
        letter-spacing: 1px;
        display: block;
        border-top: 1px solid var(--border-color);
        transition: all 0.3s ease;
    }

    .products-main {
        flex: 1;
    }

    /* ===== PAGINATION ===== */
    .pagination-wrap {
        margin-top: 50px;
        display: flex;
        justify-content: center;
    }

    @media (max-width: 1024px) {
        .collection-container {
            flex-direction: column;
            padding-left: 20px;
            padding-right: 20px;
        }

        .sidebar-filters {
            width: 100%;
        }

        .filter-card-rajwadi {
            position: static;
            max-height: none;
        }
    }
</style>

<main class="products-page">
    <!-- Breadcrumb -->
    <div class="breadcrumb-bar">
        <a href="/">Home</a>
        <span class="separator">/</span>
        <span style="color: var(--premium-gold)">All Products</span>
    </div>

    <!-- Hero Area -->
    <div class="products-hero">
        <div class="products-hero-content">
            <span class="products-hero-label">Exquisite Craftsmanship</span>
            <h1 class="products-hero-title">All Masterpieces</h1>
        </div>
    </div>

    <div class="collection-container">
        <!-- Sidebar Filters -->
        <aside class="sidebar-filters">
            <form action="{{ route('products') }}" method="GET" id="filter-form">
                <div class="filter-card-rajwadi shadow-lg">
                    <!-- Sort By -->
                    <div class="filter-accordion-item">
                        <div class="filter-header">
                            <span>Sort By</span>
                        </div>
                        <div class="filter-content">
                            <select name="sort" class="premium-input-select" onchange="this.form.submit()">
                                <option value="default" {{ request('sort') == 'default' ? 'selected' : '' }}>Featured First</option>
                                <option value="newest" {{ request('sort') == 'newest' ? 'selected' : '' }}>New Arrivals</option>
                                <option value="price_low" {{ request('sort') == 'price_low' ? 'selected' : '' }}>Price: Low to High</option>
                                <option value="price_high" {{ request('sort') == 'price_high' ? 'selected' : '' }}>Price: High to Low</option>
                            </select>
                        </div>
                    </div>

                    <!-- Metal Type -->
                    <div class="filter-accordion-item">
                        <div class="filter-header">
                            <span>Metal Type</span>
                        </div>
                        <div class="filter-content">
                            @foreach(['Gold', 'White Gold', 'Platinum', 'Silver'] as $metal)
                            <label class="raj-checkbox">
                                <input type="radio" name="metal" value="{{ $metal }}" {{ request('metal') == $metal ? 'checked' : '' }} onchange="this.form.submit()" style="display:none">
                                <span class="custom-box"></span>
                                {{ $metal }}
                            </label>
                            @endforeach
                        </div>
                    </div>

                    <!-- Price Range -->
                    <div class="filter-accordion-item">
                        <div class="filter-header">
                            <span>Price Range</span>
                        </div>
                        <div class="filter-content">
                            <select name="price_range" class="premium-input-select" onchange="this.form.submit()">
                                <option value="">Any Price</option>
                                <option value="0-50000" {{ request('price_range') == '0-50000' ? 'selected' : '' }}>Under $50,000</option>
                                <option value="50000-150000" {{ request('price_range') == '50000-150000' ? 'selected' : '' }}>$50k â€” $1.5 Lakh</option>
                                <option value="150000-500000" {{ request('price_range') == '150000-500000' ? 'selected' : '' }}>$1.5 Lakh â€” $5 Lakh</option>
                                <option value="500000+" {{ request('price_range') == '500000+' ? 'selected' : '' }}>Above $5 Lakh</option>
                            </select>
                        </div>
                    </div>

                    @if(request()->anyFilled(['sort', 'metal', 'price_range']))
                    <a href="{{ route('products') }}" class="clear-raj">Reset Filters</a>
                    @endif
                </div>
            </form>
        </aside>

        <!-- Main Products Content -->
        <div class="products-main">
            <div class="section-header">
                <div>
                    <h2>Our Jewellery</h2>
                </div>
                <div class="results-count">Showing {{ $products->count() }} of {{ $products->total() }} products</div>
            </div>

            @if($products->count() > 0)
                <div class="products-grid">
                    @foreach($products as $product)
                        <a href="{{ route('collections.product', [$product->collection->slug, $product->slug]) }}" class="product-card">
                            <div class="product-image-wrap {{ $product->image2 ? 'has-hover' : '' }}">
                                @if($product->is_featured)
                                    <span class="badge-premium">Featured</span>
                                @endif
                                @if($product->original_price && $product->original_price > $product->price)
                                    <span class="badge-premium badge-sale">Sale</span>
                                @endif
                                @if($product->is_digital)
                                    <span class="badge-premium badge-digital"><i class="bi bi-cloud-arrow-down me-1"></i> Digital Product</span>
                                @endif

                                <img src="{{ str_starts_with($product->image, 'http') ? $product->image : asset($product->image) }}"
                                    alt="{{ $product->name }}" class="main-img">
                                @if($product->image2)
                                    <img src="{{ str_starts_with($product->image2, 'http') ? $product->image2 : asset($product->image2) }}"
                                        alt="{{ $product->name }} Hover" class="hover-img">
                                @endif

                                <div class="card-actions">
                                    <form action="{{ route('wishlist.add') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                                        <button type="submit" class="card-action-btn" title="Add to Wishlist">
                                            <i class="bi bi-heart"></i>
                                        </button>
                                    </form>
                                    <form action="{{ route('cart.add') }}" method="POST" class="ajax-atc-form">
                                        @csrf
                                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                                        <button type="submit" class="card-action-btn" title="Add to Cart">
                                            <i class="bi bi-bag-plus"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>
                            <div class="product-info">
                                <div class="product-meta">{{ $product->metal_type }} {{ $product->metal_purity }}</div>
                                <h3 class="product-name">{{ $product->name }}</h3>
                                <div class="product-price">
                                    <span class="curr-price">${{ number_format($product->price) }}</span>
                                    @if($product->original_price && $product->original_price > $product->price)
                                        <span class="old-price">${{ number_format($product->original_price) }}</span>
                                    @endif
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>

                <div class="pagination-wrap">
                    {{ $products->links() }}
                </div>
            @else
                <div style="text-align: center; padding: 100px 0;">
                    <i class="bi bi-search" style="font-size: 3rem; color: var(--premium-gold); opacity: 0.3;"></i>
                    <h3 style="margin-top: 20px;">No products found</h3>
                    <p style="color: var(--premium-grey);">Try adjusting your filters or search criteria.</p>
                </div>
            @endif
        </div>
    </div>
</main>

@include('frontend.footer')


