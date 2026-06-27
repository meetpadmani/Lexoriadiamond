@include('frontend.navbar')

<style>
    /* Standard E-commerce CSS - Upgraded */
    .standard-product-page {
        max-width: 1300px;
        margin: 40px auto 80px;
        padding: 0 20px;
        font-family: 'Inter', sans-serif;
        color: #333;
    }

    .breadcrumb {
        font-size: 0.85rem;
        color: #777;
        margin-bottom: 30px;
    }

    .breadcrumb a {
        color: #777;
        text-decoration: none;
    }
    .breadcrumb a:hover {
        color: #000;
    }

    .product-main-area {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 50px;
        align-items: start;
        margin-bottom: 60px;
    }

    /* Gallery */
    .product-gallery {
        display: flex;
        flex-direction: column;
        gap: 15px;
        position: sticky;
        top: 100px;
    }

    .main-image-container {
        width: 100%;
        border: 1px solid #eaeaea;
        border-radius: 8px;
        overflow: hidden;
        background: #fdfdfd;
        box-shadow: 0 5px 15px rgba(0,0,0,0.03);
    }

    .main-image-container img {
        width: 100%;
        height: auto;
        display: block;
        transition: opacity 0.3s ease;
    }

    .thumbnail-row {
        display: flex;
        gap: 12px;
        overflow-x: auto;
        padding-bottom: 5px;
    }

    .thumbnail {
        width: 80px;
        height: 80px;
        border: 2px solid transparent;
        border-radius: 6px;
        overflow: hidden;
        cursor: pointer;
        opacity: 0.6;
        transition: all 0.2s ease;
    }

    .thumbnail.active, .thumbnail:hover {
        opacity: 1;
        border-color: #333;
    }

    .thumbnail img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    /* Details */
    .product-info {
        display: flex;
        flex-direction: column;
    }

    .p-title {
        font-size: 2.2rem;
        font-weight: 700;
        margin: 0 0 15px 0;
        color: #111;
        line-height: 1.2;
    }

    .p-price-area {
        display: flex;
        align-items: baseline;
        gap: 15px;
        margin-bottom: 25px;
        border-bottom: 1px solid #eaeaea;
        padding-bottom: 25px;
    }

    .p-price {
        font-size: 2rem;
        font-weight: 600;
        color: #111;
    }

    .p-tax {
        font-size: 0.85rem;
        color: #888;
    }

    .p-desc {
        font-size: 1rem;
        line-height: 1.6;
        color: #555;
        margin-bottom: 30px;
    }

    /* Specifications */
    .p-specs {
        background: #fdfdfd;
        border: 1px solid #eaeaea;
        border-radius: 8px;
        padding: 20px;
        margin-bottom: 30px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.02);
    }

    .p-specs-title {
        font-size: 1.1rem;
        font-weight: 600;
        margin-bottom: 15px;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .specs-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 15px;
    }

    .spec-item {
        display: flex;
        flex-direction: column;
    }

    .spec-label {
        font-size: 0.75rem;
        color: #777;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 4px;
    }

    .spec-value {
        font-weight: 600;
        color: #222;
        font-size: 0.95rem;
    }

    /* Actions */
    .p-actions {
        margin-bottom: 40px;
    }

    .action-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 15px;
        margin-bottom: 15px;
    }

    .btn-main {
        width: 100%;
        padding: 16px;
        font-size: 1rem;
        font-weight: 600;
        text-align: center;
        border-radius: 6px;
        border: none;
        cursor: pointer;
        transition: all 0.3s ease;
        text-transform: uppercase;
        letter-spacing: 1px;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        text-decoration: none;
    }

    .btn-cart {
        background: #fdfdfd;
        color: #111;
        border: 1px solid #111;
    }

    .btn-cart:hover {
        background: #f5f5f5;
    }

    .btn-buy-now {
        background: #111;
        color: #fff;
    }

    .btn-buy-now:hover {
        background: #333;
    }

    .btn-whatsapp {
        background: #25D366;
        color: #fff;
        grid-column: span 2;
    }

    .btn-whatsapp:hover {
        background: #1ebc59;
    }

    /* Trust Badges */
    .trust-badges {
        display: flex;
        justify-content: space-between;
        padding: 20px 0;
        border-top: 1px solid #eaeaea;
        margin-bottom: 30px;
    }
    .badge-item {
        display: flex;
        flex-direction: column;
        align-items: center;
        text-align: center;
        gap: 8px;
    }
    .badge-item i {
        font-size: 1.5rem;
        color: #C9A96E;
    }
    .badge-item span {
        font-size: 0.75rem;
        font-weight: 500;
        color: #555;
    }

    /* Delivery info */
    .delivery-box {
        border: 1px solid #eaeaea;
        border-radius: 8px;
        padding: 20px;
        background: #fff;
    }

    .delivery-title {
        font-weight: 600;
        margin-bottom: 15px;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .pin-input {
        display: flex;
        gap: 10px;
    }

    .pin-input input {
        flex: 1;
        padding: 12px;
        border: 1px solid #ccc;
        border-radius: 4px;
        outline: none;
    }

    .pin-input button {
        padding: 0 20px;
        background: #111;
        color: #fff;
        border: none;
        border-radius: 4px;
        font-weight: 600;
        cursor: pointer;
    }

    .digital-box {
        background: #f0faf4;
        border: 1px solid #27ae60;
    }

    .digital-box .delivery-title {
        color: #27ae60;
    }

    /* TABS SECTION */
    .rich-tabs-section {
        margin-top: 60px;
        border-top: 1px solid #eaeaea;
        padding-top: 40px;
    }

    .tabs-header {
        display: flex;
        justify-content: center;
        gap: 40px;
        border-bottom: 1px solid #eaeaea;
        margin-bottom: 40px;
    }

    .tab-btn {
        background: none;
        border: none;
        padding: 15px 0;
        font-size: 1.1rem;
        font-weight: 600;
        color: #888;
        cursor: pointer;
        border-bottom: 2px solid transparent;
        transition: all 0.3s;
    }

    .tab-btn.active {
        color: #111;
        border-bottom-color: #111;
    }

    .tab-content {
        display: none;
        max-width: 900px;
        margin: 0 auto;
        animation: fadeIn 0.4s ease;
    }

    .tab-content.active {
        display: block;
    }

    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }

    /* Price Breakup Table */
    .price-table {
        width: 100%;
        border-collapse: collapse;
    }
    .price-table th, .price-table td {
        padding: 15px;
        border-bottom: 1px solid #eaeaea;
        text-align: left;
    }
    .price-table th {
        background: #f9f9f9;
        font-weight: 600;
    }

    /* Related Products */
    .related-section {
        margin-top: 80px;
        padding-top: 60px;
        border-top: 1px solid #eaeaea;
    }

    .related-title {
        text-align: center;
        font-size: 2rem;
        font-weight: 700;
        margin-bottom: 40px;
    }

    .related-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 20px;
    }

    .related-card {
        border: 1px solid #eaeaea;
        border-radius: 8px;
        overflow: hidden;
        text-decoration: none;
        color: #333;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .related-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.05);
    }

    .r-img {
        width: 100%;
        aspect-ratio: 1;
        object-fit: cover;
    }

    .r-info {
        padding: 15px;
        text-align: center;
    }

    .r-name {
        font-weight: 600;
        margin-bottom: 8px;
    }

    .r-price {
        font-weight: 700;
        color: #111;
    }

    @media (max-width: 900px) {
        .product-main-area {
            grid-template-columns: 1fr;
        }
        .product-gallery {
            position: static;
        }
        .p-title {
            font-size: 1.8rem;
        }
        .related-grid {
            grid-template-columns: repeat(2, 1fr);
        }
        .tabs-header {
            gap: 20px;
            overflow-x: auto;
            white-space: nowrap;
            justify-content: flex-start;
        }
    }
</style>

@php
    $images = [$product->image];
    if ($product->image2) $images[] = $product->image2;
    if ($product->image3) $images[] = $product->image3;
    if ($product->image4) $images[] = $product->image4;
    if ($product->image5) $images[] = $product->image5;
    if ($product->image6) $images[] = $product->image6;
@endphp

<main class="standard-product-page">
    
    <div class="breadcrumb">
        <a href="/">Home</a> / 
        <a href="{{ route('collections.show', $collection->slug) }}">{{ $collection->title }}</a> / 
        <span style="color: #000;">{{ $product->name }}</span>
    </div>

    <div class="product-main-area">
        
        <!-- Left: Image Gallery -->
        <div class="product-gallery">
            <div class="main-image-container">
                <img id="mainImage" src="{{ str_starts_with($images[0], 'http') ? $images[0] : asset($images[0]) }}" alt="{{ $product->name }}">
            </div>
            
            @if(count($images) > 1)
            <div class="thumbnail-row">
                @foreach($images as $index => $img)
                    @php $src = str_starts_with($img, 'http') ? $img : asset($img); @endphp
                    <div class="thumbnail {{ $index == 0 ? 'active' : '' }}" onclick="changeImage('{{ $src }}', this)">
                        <img src="{{ $src }}" alt="Thumbnail {{ $index }}">
                    </div>
                @endforeach
            </div>
            @endif
        </div>

        <!-- Right: Product Details -->
        <div class="product-info">
            
            <h1 class="p-title">{{ $product->name }}</h1>
            
            <div class="p-price-area">
                <span class="p-price">${{ number_format($product->price) }}</span>
                <span class="p-tax">Inclusive of all taxes</span>
            </div>

            <p class="p-desc">{{ $product->description }}</p>

            <div class="p-specs">
                <div class="p-specs-title"><i class="bi bi-info-circle"></i> Quick Details</div>
                <div class="specs-grid">
                    @if($product->sku)
                    <div class="spec-item">
                        <span class="spec-label">SKU</span>
                        <span class="spec-value">{{ $product->sku }}</span>
                    </div>
                    @endif
                    @if($product->metal_type)
                    <div class="spec-item">
                        <span class="spec-label">Material</span>
                        <span class="spec-value">{{ $product->metal_type }} {{ $product->metal_purity }}</span>
                    </div>
                    @endif
                    @if($product->weight)
                    <div class="spec-item">
                        <span class="spec-label">Gross Weight</span>
                        <span class="spec-value">{{ $product->weight }}g</span>
                    </div>
                    @endif
                </div>
            </div>

            <!-- Trust Badges -->
            <div class="trust-badges">
                <div class="badge-item">
                    <i class="bi bi-gem"></i>
                    <span>GIA Certified</span>
                </div>
                <div class="badge-item">
                    <i class="bi bi-globe-americas"></i>
                    <span>Conflict-Free</span>
                </div>
                <div class="badge-item">
                    <i class="bi bi-shield-check"></i>
                    <span>Lifetime Warranty</span>
                </div>
                <div class="badge-item">
                    <i class="bi bi-truck"></i>
                    <span>Free US Shipping</span>
                </div>
            </div>

            <!-- Actions -->
            <div class="p-actions">
                <div class="action-grid">
                    <form action="{{ route('cart.add') }}" method="POST" style="margin: 0; width: 100%;">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        <button type="submit" class="btn-main btn-cart"><i class="bi bi-bag"></i> Add to Cart</button>
                    </form>
                    <form action="{{ route('cart.add') }}" method="POST" style="margin: 0; width: 100%;">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        <input type="hidden" name="buy_now" value="1">
                        <button type="submit" class="btn-main btn-buy-now" style="width: 100%;">Buy Now</button>
                    </form>
                    
                    @if($product->is_digital)
                        <a href="https://wa.me/10000000000?text={{ urlencode('I want to buy this digital product: ' . $product->name . ' (' . url()->current() . ')') }}" target="_blank" class="btn-main btn-whatsapp">
                            <i class="bi bi-whatsapp"></i> Buy on WhatsApp
                        </a>
                    @endif
                </div>
                
                <!-- Secure Checkout Banner -->
                <div style="text-align: center; margin-top: 15px; padding: 15px; border: 1px dashed #eaeaea; border-radius: 6px; background: #fafafa;">
                    <div style="font-size: 0.8rem; color: #555; margin-bottom: 8px; font-weight: 600; text-transform: uppercase; letter-spacing: 1px;"><i class="bi bi-lock-fill" style="color: #27ae60;"></i> Secure & Encrypted Checkout</div>
                    <div style="font-size: 1.5rem; color: #888; display: flex; justify-content: center; gap: 15px;">
                        <i class="bi bi-credit-card-2-front"></i>
                        <i class="bi bi-paypal"></i>
                        <i class="bi bi-stripe"></i>
                        <i class="bi bi-apple"></i>
                    </div>
                </div>
            </div>

            <!-- Delivery -->
            @if($product->is_digital)
                <div class="delivery-box digital-box">
                    <div class="delivery-title"><i class="bi bi-cloud-arrow-down"></i> Digital Delivery</div>
                    <p style="font-size: 0.9rem; color: #444; margin: 0;">This is a digital product. You will receive a secure link to download the files immediately after completing your purchase. No physical shipping is required.</p>
                </div>
            @else
                <div class="delivery-box">
                    <div class="delivery-title"><i class="bi bi-truck"></i> Delivery Options</div>
                    <div class="pin-input">
                        <input type="text" id="pincode" placeholder="Enter Pincode">
                        <button type="button" onclick="checkPin()">Check</button>
                    </div>
                    <div id="pin-result" style="margin-top: 10px; font-size: 0.85rem; display: none;"></div>
                </div>
            @endif

        </div>
    </div>

    <!-- Rich Information Tabs -->
    <div class="rich-tabs-section">
        <div class="tabs-header">
            <button class="tab-btn active" onclick="openTab(event, 'tab-desc')">Description</button>
            <button class="tab-btn" onclick="openTab(event, 'tab-price')">Price Breakup</button>
            <button class="tab-btn" onclick="openTab(event, 'tab-reviews')">Reviews</button>
        </div>

        <div id="tab-desc" class="tab-content active">
            <h3 style="margin-bottom: 20px;">About this Masterpiece</h3>
            <p style="line-height: 1.8; color: #555;">{{ $product->description }}</p>
            <p style="line-height: 1.8; color: #555; margin-top: 15px;">Every piece of Lexoria diamond jewelry is crafted to perfection by master artisans in our US-based studios. We source our diamonds strictly following the Kimberley Process, ensuring they are 100% conflict-free and ethically mined. Each piece comes with a certificate of authenticity and a lifetime warranty against manufacturing defects.</p>
        </div>

        <div id="tab-price" class="tab-content">
            <h3 style="margin-bottom: 20px;">Transparent Pricing</h3>
            <table class="price-table">
                <tr>
                    <th>Component</th>
                    <th>Rate</th>
                    <th>Weight</th>
                    <th>Value</th>
                </tr>
                @if($product->is_digital)
                <tr>
                    <td>Digital License / Asset Fee</td>
                    <td>-</td>
                    <td>-</td>
                    <td>${{ number_format($product->price) }}</td>
                </tr>
                <tr>
                    <td>GST (Digital Goods)</td>
                    <td>-</td>
                    <td>-</td>
                    <td style="color: #27ae60;">$0 (Exempt)</td>
                </tr>
                @else
                <tr>
                    <td>{{ $product->metal_type }} {{ $product->metal_purity }}</td>
                    <td>-</td>
                    <td>{{ $product->weight }}g</td>
                    <td>${{ number_format($product->price * 0.75) }}</td>
                </tr>
                <tr>
                    <td>Making Charges</td>
                    <td>-</td> 
                    <td>-</td>
                    <td>${{ number_format($product->price * 0.20) }}</td>
                </tr>
                <tr>
                    <td>GST (3%)</td>
                    <td>-</td>
                    <td>-</td>
                    <td>${{ number_format($product->price * 0.05) }}</td>
                </tr>
                @endif
                <tr style="font-weight: 700; background: #fdfdfd;">
                    <td colspan="3">Final Price</td>
                    <td style="font-size: 1.2rem; color: #111;">${{ number_format($product->price) }}</td>
                </tr>
            </table>
        </div>

        <div id="tab-reviews" class="tab-content">
            <h3 style="margin-bottom: 20px;">Customer Feedback</h3>
            @if(isset($reviews) && $reviews->count() > 0)
                <div style="display: flex; flex-direction: column; gap: 20px;">
                @foreach($reviews as $review)
                    <div style="padding: 20px; border: 1px solid #eaeaea; border-radius: 8px;">
                        <div style="display: flex; justify-content: space-between; margin-bottom: 10px;">
                            <strong style="color: #111;">{{ $review->user->name ?? 'Valued Customer' }}</strong>
                            <div style="color: #f1c40f;">
                                @for($i=0; $i<5; $i++)
                                    <i class="bi bi-star-fill"></i>
                                @endfor
                            </div>
                        </div>
                        <p style="color: #555; margin: 0; font-style: italic;">"{{ $review->comment }}"</p>
                    </div>
                @endforeach
                </div>
            @else
                <div style="text-align: center; padding: 40px; background: #f9f9f9; border-radius: 8px;">
                    <i class="bi bi-chat-heart" style="font-size: 2.5rem; color: #ccc; margin-bottom: 15px; display: block;"></i>
                    <p style="color: #777;">No reviews yet. Be the first to share your experience!</p>
                </div>
            @endif
        </div>
    </div>

    <!-- Related Products -->
    @if(isset($relatedProducts) && $relatedProducts->count() > 0)
    <div class="related-section">
        <h2 class="related-title">You May Also Like</h2>
        <div class="related-grid">
            @foreach($relatedProducts as $related)
            <a href="{{ route('collections.product', [$collection->slug, $related->slug]) }}" class="related-card">
                <img src="{{ str_starts_with($related->image, 'http') ? $related->image : asset($related->image) }}" alt="{{ $related->name }}" class="r-img">
                <div class="r-info">
                    <div class="r-name">{{ $related->name }}</div>
                    <div class="r-price">${{ number_format($related->price) }}</div>
                </div>
            </a>
            @endforeach
        </div>
    </div>
    @endif

</main>

<script>
    // Gallery Image Change
    function changeImage(src, element) {
        const mainImg = document.getElementById('mainImage');
        mainImg.style.opacity = '0';
        
        setTimeout(() => {
            mainImg.src = src;
            mainImg.style.opacity = '1';
        }, 150);

        document.querySelectorAll('.thumbnail').forEach(t => t.classList.remove('active'));
        element.classList.add('active');
    }

    // Pincode Check
    function checkPin() {
        const res = document.getElementById('pin-result');
        res.style.display = 'block';
        res.style.color = '#27ae60';
        res.innerHTML = '<i class="bi bi-check-circle"></i> Delivery available in 3-5 days.';
    }

    // Tab Switching Logic
    function openTab(evt, tabId) {
        // Hide all contents
        const tabContents = document.getElementsByClassName("tab-content");
        for (let i = 0; i < tabContents.length; i++) {
            tabContents[i].classList.remove("active");
        }

        // Remove active class from all buttons
        const tabLinks = document.getElementsByClassName("tab-btn");
        for (let i = 0; i < tabLinks.length; i++) {
            tabLinks[i].classList.remove("active");
        }

        // Show the current tab, and add an "active" class to the button
        document.getElementById(tabId).classList.add("active");
        evt.currentTarget.classList.add("active");
    }
</script>

@include('frontend.footer')
