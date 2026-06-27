@include('frontend.navbar')

<style>
    :root {
        --raj-maroon: #0F1F17;
        --raj-maroon-deep: #000000;
        --raj-gold: #b58d55;
        --raj-gold-dark: #8a6b3e;
        --raj-sand: #fdfaf7;
        --raj-text: #333333;
        --raj-grey: #8a735a;
        --raj-border: rgba(0, 0, 0, 0.08);
        --font-heading: 'Playfair Display', serif;
        --font-accent: 'Inter', sans-serif;
        --font-body: 'Outfit', sans-serif;
    }

    body {
        background-color: var(--raj-sand);
        font-family: var(--font-body);
        color: var(--raj-text);
    }

    /* Ambient Background */
    .cart-bg-pattern {
        position: fixed;
        inset: 0;
        background: radial-gradient(circle at 100% 0%, rgba(181, 141, 85, 0.05) 0%, transparent 40%),
                    radial-gradient(circle at 0% 100%, rgba(15, 31, 23, 0.03) 0%, transparent 40%);
        z-index: -1;
        pointer-events: none;
    }

    .cart-page {
        max-width: 1400px;
        margin: 0 auto;
        padding: 80px 40px 120px;
    }

    /* ===== ROYAL HEADER ===== */
    .cart-royal-header {
        text-align: center;
        margin-bottom: 70px;
        position: relative;
    }

    .cart-royal-header .sub-text {
        font-family: var(--font-accent);
        font-size: 0.8rem;
        text-transform: uppercase;
        letter-spacing: 5px;
        color: var(--raj-grey);
        margin-bottom: 15px;
        display: block;
        font-weight: 500;
    }

    .cart-royal-header h1 {
        font-family: var(--font-heading);
        font-size: clamp(2.8rem, 5vw, 4rem);
        color: var(--raj-maroon);
        margin: 0;
        font-weight: 600;
        line-height: 1.1;
    }

    /* ===== CART LAYOUT ===== */
    .cart-layout {
        display: grid;
        grid-template-columns: 1fr 400px;
        gap: 60px;
        align-items: start;
    }

    /* ===== CART ITEMS PANEL ===== */
    .cart-items-panel {
        background: #ffffff;
        border-radius: 16px;
        padding: 40px;
        box-shadow: 0 15px 50px rgba(0, 0, 0, 0.03);
        border: 1px solid var(--raj-border);
    }

    .cart-header-row {
        display: grid;
        grid-template-columns: 2fr 1fr 1fr 1fr;
        padding-bottom: 20px;
        border-bottom: 1px solid var(--raj-border);
        margin-bottom: 20px;
    }

    .cart-header-row span {
        font-family: var(--font-accent);
        font-size: 0.75rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 2px;
        color: var(--raj-grey);
    }
    
    .cart-header-row span:not(:first-child) {
        text-align: right;
    }

    /* Cart Item Row */
    .cart-item-row {
        display: grid;
        grid-template-columns: 2fr 1fr 1fr 1fr;
        align-items: center;
        padding: 25px 0;
        border-bottom: 1px solid var(--raj-border);
        transition: all 0.3s ease;
    }

    .cart-item-row:last-child {
        border-bottom: none;
        padding-bottom: 10px;
    }

    .cart-product-cell {
        display: flex;
        align-items: center;
        gap: 25px;
    }

    .cart-product-img-wrap {
        position: relative;
        flex-shrink: 0;
        width: 100px;
        height: 100px;
        border-radius: 12px;
        overflow: hidden;
        background: #f8f8f8;
        border: 1px solid var(--raj-border);
    }

    .cart-product-img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.5s ease;
    }

    .cart-product-img-wrap:hover .cart-product-img {
        transform: scale(1.05);
    }

    .btn-remove-item {
        position: absolute;
        top: 5px;
        left: 5px;
        width: 24px;
        height: 24px;
        background: #ffffff;
        color: #ff4757;
        border: 1px solid rgba(255, 71, 87, 0.2);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 0.8rem;
        cursor: pointer;
        transition: all 0.3s ease;
        padding: 0;
        box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        z-index: 2;
    }

    .btn-remove-item:hover {
        background: #ff4757;
        color: #ffffff;
        transform: scale(1.1);
    }

    .cart-product-name {
        font-family: var(--font-heading);
        font-weight: 600;
        font-size: 1.2rem;
        margin-bottom: 6px;
        color: var(--raj-maroon);
    }

    .cart-product-sku {
        font-size: 0.75rem;
        font-family: var(--font-accent);
        text-transform: uppercase;
        letter-spacing: 1px;
        color: var(--raj-grey);
    }

    .cart-price {
        font-weight: 500;
        color: var(--raj-text);
        font-size: 1.05rem;
        text-align: right;
    }

    /* Quantity Controls */
    .qty-control-wrapper {
        display: flex;
        justify-content: flex-end;
    }

    .qty-control {
        display: inline-flex;
        align-items: center;
        background: #f8f8f8;
        border-radius: 8px;
        border: 1px solid var(--raj-border);
        overflow: hidden;
    }

    .qty-btn {
        width: 32px;
        height: 36px;
        background: transparent;
        border: none;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: all 0.3s ease;
        color: var(--raj-text);
        font-size: 1rem;
    }

    .qty-btn:hover:not(:disabled) {
        background: #ebebeb;
        color: var(--raj-maroon);
    }

    .qty-btn:disabled {
        opacity: 0.3;
        cursor: not-allowed;
    }

    .qty-value {
        width: 35px;
        text-align: center;
        font-weight: 600;
        font-size: 0.95rem;
        color: var(--raj-maroon);
    }

    .cart-subtotal {
        font-weight: 700;
        color: var(--raj-maroon);
        font-size: 1.15rem;
        text-align: right;
    }

    /* Continue Link */
    .continue-link {
        display: inline-flex;
        align-items: center;
        gap: 12px;
        margin-top: 30px;
        text-decoration: none;
        color: var(--raj-grey);
        font-family: var(--font-accent);
        font-size: 0.8rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 2px;
        transition: all 0.3s ease;
    }

    .continue-link:hover {
        color: var(--raj-gold);
        gap: 18px;
    }

    /* ===== ORDER SUMMARY SIDEBAR ===== */
    .order-summary-panel {
        background: #ffffff;
        border-radius: 16px;
        padding: 40px;
        box-shadow: 0 15px 50px rgba(0, 0, 0, 0.04);
        border: 1px solid var(--raj-border);
        position: sticky;
        top: 100px;
    }

    .summary-title {
        font-family: var(--font-heading);
        font-size: 1.8rem;
        color: var(--raj-maroon);
        margin-top: 0;
        margin-bottom: 30px;
        padding-bottom: 20px;
        border-bottom: 1px solid var(--raj-border);
    }

    .summary-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
        font-size: 1rem;
    }

    .summary-row .label {
        color: var(--raj-grey);
    }

    .summary-row .value {
        font-weight: 600;
        color: var(--raj-maroon);
    }

    .summary-row.free-delivery .value {
        color: #27ae60;
        background: #f0fdf4;
        padding: 4px 10px;
        border-radius: 20px;
        font-size: 0.8rem;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    .summary-divider {
        height: 1px;
        background: var(--raj-border);
        margin: 25px 0;
    }

    .summary-total {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 35px;
    }

    .summary-total .label {
        font-family: var(--font-heading);
        font-size: 1.3rem;
        color: var(--raj-maroon);
    }

    .summary-total .value {
        font-family: var(--font-heading);
        font-size: 1.8rem;
        font-weight: 700;
        color: var(--raj-maroon);
    }

    .btn-checkout {
        display: block;
        width: 100%;
        padding: 20px;
        background: var(--raj-maroon);
        color: #ffffff;
        text-align: center;
        text-decoration: none;
        font-family: var(--font-accent);
        font-weight: 600;
        font-size: 0.9rem;
        text-transform: uppercase;
        letter-spacing: 3px;
        border: none;
        border-radius: 8px;
        cursor: pointer;
        transition: all 0.4s ease;
        position: relative;
        z-index: 10;
    }

    .btn-checkout:hover {
        background: var(--raj-gold);
        transform: translateY(-2px);
        box-shadow: 0 10px 25px rgba(181, 141, 85, 0.3);
        color: #ffffff;
    }

    .trust-badge {
        text-align: center;
        margin-top: 25px;
        font-size: 0.75rem;
        text-transform: uppercase;
        letter-spacing: 1px;
        color: var(--raj-grey);
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
    }

    .trust-badge i {
        color: var(--raj-gold);
        font-size: 1.1rem;
    }

    /* ===== EMPTY CART ===== */
    .empty-cart {
        text-align: center;
        padding: 100px 20px;
        background: #ffffff;
        border-radius: 16px;
        border: 1px solid var(--raj-border);
        box-shadow: 0 15px 50px rgba(0, 0, 0, 0.03);
        max-width: 800px;
        margin: 0 auto;
    }

    .empty-cart-icon {
        font-size: 4rem;
        color: var(--raj-gold);
        margin-bottom: 30px;
        display: block;
    }

    .empty-cart h2 {
        font-family: var(--font-heading);
        font-size: 2.5rem;
        color: var(--raj-maroon);
        margin-bottom: 15px;
    }

    .empty-cart p {
        color: var(--raj-grey);
        max-width: 400px;
        margin: 0 auto 40px;
        line-height: 1.6;
        font-size: 1.1rem;
    }

    .btn-explore {
        display: inline-block;
        padding: 18px 40px;
        background: var(--raj-maroon);
        color: #fff;
        text-decoration: none;
        font-family: var(--font-accent);
        font-weight: 600;
        font-size: 0.85rem;
        text-transform: uppercase;
        letter-spacing: 2px;
        border-radius: 8px;
        transition: all 0.4s ease;
    }

    .btn-explore:hover {
        background: var(--raj-gold);
        transform: translateY(-2px);
        box-shadow: 0 10px 25px rgba(181, 141, 85, 0.3);
    }

    /* ===== ANIMATIONS ===== */
    @keyframes fadeInUp {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }

    .animate-in {
        animation: fadeInUp 0.8s cubic-bezier(0.19, 1, 0.22, 1) forwards;
    }

    /* ===== RESPONSIVE ===== */
    @media (max-width: 1024px) {
        .cart-layout {
            grid-template-columns: 1fr;
            gap: 40px;
        }

        .order-summary-panel {
            position: static;
        }

        .cart-page {
            padding: 60px 20px 80px;
        }
    }

    @media (max-width: 768px) {
        .cart-royal-header h1 {
            font-size: 2.2rem;
        }

        .cart-header-row {
            display: none;
        }

        .cart-item-row {
            grid-template-columns: 1fr;
            gap: 15px;
            padding: 20px 0;
        }
        
        .cart-items-panel {
            padding: 25px;
        }

        .cart-price, .cart-subtotal, .qty-control-wrapper {
            text-align: left;
            justify-content: flex-start;
        }
        
        .cart-price::before {
            content: 'Price: ';
            font-size: 0.8rem;
            color: var(--raj-grey);
            margin-right: 5px;
        }
        
        .cart-subtotal::before {
            content: 'Subtotal: ';
            font-size: 0.8rem;
            color: var(--raj-grey);
            margin-right: 5px;
        }
    }
</style>

<div class="cart-bg-pattern"></div>

<div class="cart-page">
    <header class="cart-royal-header animate-in">
        <span class="sub-text">Lexoria Diamond</span>
        <h1>Your Shopping Bag</h1>
    </header>

    @if(session('error'))
        <div class="animate-in" style="background: #fff5f5; color: #c53030; padding: 20px; border-left: 5px solid #c53030; margin-bottom: 30px; border-radius: 8px; font-weight: 500;">
            <i class="bi bi-exclamation-triangle-fill me-2"></i> {{ session('error') }}
        </div>
    @endif

    @if(session('success'))
        <div class="animate-in" style="background: #f0fdf4; color: #166534; padding: 20px; border-left: 5px solid #27ae60; margin-bottom: 30px; border-radius: 8px; font-weight: 500;">
            <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
        </div>
    @endif

    @if(count($cartItems) > 0)
        @php $total = 0; @endphp
        @foreach($cartItems as $id => $item)
            @php $total += $item['price'] * $item['quantity']; @endphp
        @endforeach

        <div class="cart-layout">
            <!-- Cart Items -->
            <div class="animate-in" style="animation-delay: 0.2s;">
                <div class="cart-items-panel">
                    <div class="cart-header-row">
                        <span>Product</span>
                        <span>Price</span>
                        <span>Quantity</span>
                        <span>Total</span>
                    </div>
                    
                    @foreach($cartItems as $id => $item)
                        <div class="cart-item-row">
                            <div class="cart-product-cell">
                                <div class="cart-product-img-wrap">
                                    <img src="{{ str_starts_with($item['image'], 'http') ? $item['image'] : asset($item['image']) }}"
                                         alt="{{ $item['name'] }}" class="cart-product-img">
                                    <form action="{{ route('cart.remove') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="id" value="{{ $id }}">
                                        <button type="submit" class="btn-remove-item" title="Remove Item">
                                            <i class="bi bi-x-lg"></i>
                                        </button>
                                    </form>
                                </div>
                                <div>
                                    <div class="cart-product-name">{{ $item['name'] }}</div>
                                    <div class="cart-product-sku">ID: #{{ substr($id, 0, 8) }}</div>
                                </div>
                            </div>
                            
                            <div class="cart-price">
                                ${{ number_format($item['price']) }}
                            </div>
                            
                            <div class="qty-control-wrapper">
                                @php
                                    $isDigital = false;
                                    $product = \App\Models\Product::find($item['id'] ?? null);
                                    if ($product && $product->is_digital) {
                                        $isDigital = true;
                                    }
                                @endphp
                                <div class="qty-control">
                                    @if($isDigital)
                                        <span style="font-size: 0.85rem; color: var(--raj-grey); background: rgba(0,0,0,0.03); padding: 5px 15px; border-radius: 20px; font-weight: 500;">Digital</span>
                                    @else
                                        <form action="{{ route('cart.update') }}" method="POST" style="margin: 0;">
                                            @csrf
                                            <input type="hidden" name="id" value="{{ $id }}">
                                            <input type="hidden" name="quantity" value="{{ $item['quantity'] - 1 }}">
                                            <button type="submit" class="qty-btn" {{ $item['quantity'] <= 1 ? 'disabled' : '' }}>
                                                <i class="bi bi-dash"></i>
                                            </button>
                                        </form>
                                        <span class="qty-value">{{ $item['quantity'] }}</span>
                                        <form action="{{ route('cart.update') }}" method="POST" style="margin: 0;">
                                            @csrf
                                            <input type="hidden" name="id" value="{{ $id }}">
                                            <input type="hidden" name="quantity" value="{{ $item['quantity'] + 1 }}">
                                            <button type="submit" class="qty-btn">
                                                <i class="bi bi-plus"></i>
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </div>
                            
                            <div class="cart-subtotal">
                                ${{ number_format($item['price'] * $item['quantity']) }}
                            </div>
                        </div>
                    @endforeach
                </div>

                <a href="{{ route('collections') }}" class="continue-link">
                    <i class="bi bi-arrow-left"></i> Continue Shopping
                </a>
            </div>

            <!-- Order Summary -->
            <div class="animate-in" style="animation-delay: 0.4s;">
                <div class="order-summary-panel">
                    <h2 class="summary-title">Order Summary</h2>

                    <div class="summary-row">
                        <span class="label">Subtotal</span>
                        <span class="value">${{ number_format($total) }}</span>
                    </div>
                    <div class="summary-row free-delivery">
                        <span class="label">Shipping</span>
                        <span class="value">Free</span>
                    </div>

                    <div class="summary-divider"></div>

                    <div class="summary-total">
                        <span class="label">Total</span>
                        <span class="value">${{ number_format($total) }}</span>
                    </div>

                    <a href="{{ route('checkout.index') }}" class="btn-checkout">
                        Proceed to Checkout
                    </a>

                    <div class="trust-badge">
                        <i class="bi bi-shield-lock"></i>
                        Secure Encrypted Checkout
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="empty-cart animate-in">
            <i class="bi bi-bag empty-cart-icon"></i>
            <h2>Your bag is empty</h2>
            <p>Discover our exclusive collections and find the perfect masterpiece to add to your collection.</p>
            <a href="{{ route('collections') }}" class="btn-explore">Explore Collections</a>
        </div>
    @endif
</div>

@include('frontend.footer')

