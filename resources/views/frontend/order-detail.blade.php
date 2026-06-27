@include('frontend.navbar')

<!-- Premium Fonts -->
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600&family=Playfair+Display:wght@400;500;600;700&family=Outfit:wght@300;400;500;600&display=swap" rel="stylesheet">

<style>
    :root {
        --raj-maroon: #0F1F17;
        --raj-gold: #c5a059;
        --raj-sand: #ffffff;
        --raj-sand-light: #fbfbfb;
        --raj-grey: #8a8a8a;
        --raj-border: #eaeaea;
        --font-heading: 'Playfair Display', serif;
        --font-accent: 'Inter', sans-serif;
        --font-body: 'Outfit', sans-serif;
    }

    body {
        background-color: var(--raj-sand-light);
        font-family: var(--font-body);
        color: var(--raj-maroon);
        -webkit-font-smoothing: antialiased;
    }

    .order-hero {
        padding: 60px 20px 40px;
        text-align: center;
        background: var(--raj-sand-light);
    }

    .order-hero h1 {
        font-family: var(--font-heading);
        font-size: 3rem;
        color: var(--raj-maroon);
        margin: 0 0 10px;
        font-weight: 500;
    }

    .order-badge {
        display: inline-block;
        background: var(--raj-sand);
        color: var(--raj-maroon);
        padding: 8px 20px;
        border-radius: 50px;
        font-family: var(--font-accent);
        font-size: 0.85rem;
        letter-spacing: 1px;
        border: 1px solid var(--raj-gold);
        font-weight: 500;
    }

    .order-container {
        max-width: 1200px;
        margin: 0 auto 100px;
        padding: 0 40px;
    }

    .order-card {
        background: var(--raj-sand);
        border-radius: 16px;
        border: 1px solid var(--raj-border);
        box-shadow: 0 20px 40px rgba(0,0,0,0.03);
        overflow: hidden;
    }

    /* STATUS BANNER */
    .status-banner {
        padding: 40px 50px;
        background: linear-gradient(to right, var(--raj-maroon), #162c21);
        color: var(--raj-sand);
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .status-text h2 {
        font-family: var(--font-heading);
        font-size: 2rem;
        margin: 0 0 5px;
        text-transform: capitalize;
        color: var(--raj-gold);
    }

    .status-text p {
        font-family: var(--font-accent);
        margin: 0;
        color: rgba(255,255,255,0.7);
        font-size: 0.9rem;
    }

    .status-icon {
        width: 70px;
        height: 70px;
        background: rgba(255,255,255,0.1);
        border: 1px solid rgba(197, 160, 89, 0.3);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--raj-gold);
        font-size: 2rem;
    }

    /* TIMELINE */
    .timeline-wrapper {
        padding: 50px;
        background: var(--raj-sand);
        border-bottom: 1px solid var(--raj-border);
    }

    .timeline-steps {
        display: flex;
        justify-content: space-between;
        position: relative;
    }

    .timeline-steps::before {
        content: '';
        position: absolute;
        top: 25px;
        left: 10%;
        right: 10%;
        height: 2px;
        background: var(--raj-border);
        z-index: 1;
    }

    .timeline-step {
        position: relative;
        z-index: 2;
        text-align: center;
        width: 25%;
    }

    .step-circle {
        width: 52px;
        height: 52px;
        background: var(--raj-sand);
        border: 2px solid var(--raj-border);
        border-radius: 50%;
        margin: 0 auto 15px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.2rem;
        color: var(--raj-grey);
        transition: all 0.3s ease;
    }

    .timeline-step.completed .step-circle {
        background: var(--raj-gold);
        border-color: var(--raj-gold);
        color: var(--raj-sand);
    }

    .timeline-step.active .step-circle {
        background: var(--raj-maroon);
        border-color: var(--raj-maroon);
        color: var(--raj-gold);
        box-shadow: 0 0 0 6px rgba(197, 160, 89, 0.2);
    }

    .step-name {
        font-family: var(--font-accent);
        font-size: 0.8rem;
        text-transform: uppercase;
        letter-spacing: 1px;
        font-weight: 500;
        color: var(--raj-grey);
    }

    .timeline-step.completed .step-name,
    .timeline-step.active .step-name {
        color: var(--raj-maroon);
        font-weight: 600;
    }

    /* GRID LAYOUT */
    .details-grid {
        display: grid;
        grid-template-columns: 1.5fr 1fr;
    }

    .items-section {
        padding: 50px;
        border-right: 1px solid var(--raj-border);
    }

    .info-section {
        padding: 50px;
        background: var(--raj-sand-light);
    }

    .section-title {
        font-family: var(--font-heading);
        font-size: 1.5rem;
        color: var(--raj-maroon);
        margin-bottom: 30px;
        padding-bottom: 15px;
        border-bottom: 1px solid var(--raj-border);
    }

    /* ITEMS */
    .order-item {
        display: flex;
        gap: 25px;
        margin-bottom: 30px;
    }

    .order-item-img {
        width: 100px;
        height: 100px;
        border-radius: 8px;
        object-fit: cover;
        border: 1px solid var(--raj-border);
    }

    .order-item-info h4 {
        font-family: var(--font-heading);
        font-size: 1.2rem;
        margin: 0 0 5px;
        color: var(--raj-maroon);
    }

    .order-item-sku {
        font-family: var(--font-accent);
        font-size: 0.8rem;
        color: var(--raj-grey);
        margin-bottom: 10px;
    }

    .order-item-price {
        font-family: var(--font-accent);
        color: var(--raj-maroon);
        font-weight: 500;
        font-size: 1rem;
    }

    .btn-review {
        display: inline-block;
        margin-top: 10px;
        font-family: var(--font-accent);
        font-size: 0.75rem;
        text-transform: uppercase;
        letter-spacing: 1px;
        color: var(--raj-maroon);
        border: 1px solid var(--raj-border);
        padding: 8px 15px;
        border-radius: 4px;
        text-decoration: none;
        transition: all 0.3s ease;
    }

    .btn-review:hover {
        border-color: var(--raj-gold);
        color: var(--raj-gold);
    }

    /* INFO CARDS */
    .info-card {
        background: var(--raj-sand);
        border: 1px solid var(--raj-border);
        border-radius: 12px;
        padding: 25px;
        margin-bottom: 30px;
    }

    .info-card h5 {
        font-family: var(--font-accent);
        font-size: 0.8rem;
        text-transform: uppercase;
        letter-spacing: 1.5px;
        color: var(--raj-grey);
        margin-bottom: 15px;
    }

    .info-card p {
        margin: 5px 0;
        font-size: 0.95rem;
        color: var(--raj-maroon);
    }

    /* TRACKING CARD */
    .tracking-card {
        border-color: var(--raj-gold);
        background: #fdfaf5;
    }

    .tracking-card h5 {
        color: var(--raj-gold);
    }

    .tracking-number {
        font-family: var(--font-accent);
        font-weight: 600;
        font-size: 1.2rem;
        color: var(--raj-maroon);
        margin-top: 5px;
    }

    .btn-track {
        display: block;
        width: 100%;
        text-align: center;
        background: var(--raj-maroon);
        color: var(--raj-sand);
        padding: 12px;
        border-radius: 6px;
        font-family: var(--font-accent);
        font-size: 0.8rem;
        text-transform: uppercase;
        letter-spacing: 1.5px;
        text-decoration: none;
        margin-top: 15px;
        transition: all 0.3s ease;
    }

    .btn-track:hover {
        background: var(--raj-gold);
        color: var(--raj-sand);
    }

    /* SUMMARY */
    .summary-table {
        width: 100%;
        font-family: var(--font-accent);
        font-size: 0.9rem;
    }

    .summary-table td {
        padding: 10px 0;
        color: var(--raj-maroon);
    }

    .summary-table .label {
        color: var(--raj-grey);
    }

    .summary-table .amount {
        text-align: right;
        font-weight: 500;
    }

    .total-row {
        border-top: 1px solid var(--raj-border);
        font-size: 1.2rem;
    }

    .total-row td {
        padding-top: 20px;
        font-family: var(--font-heading);
        font-weight: 600;
    }

    @media (max-width: 992px) {
        .details-grid { grid-template-columns: 1fr; }
        .items-section { border-right: none; border-bottom: 1px solid var(--raj-border); }
        .timeline-steps::before { display: none; }
        .timeline-steps { flex-direction: column; gap: 20px; }
        .timeline-step { width: 100%; display: flex; align-items: center; text-align: left; gap: 20px; }
        .step-circle { margin: 0; }
        .order-container { padding: 0 20px; }
    }
</style>

<div class="order-hero">
    <h1>Order Details</h1>
    <div class="order-badge">Order #{{ $order->order_number }}</div>
    <div style="margin-top: 20px;">
        <a href="{{ route('profile.index') }}" style="color: var(--raj-grey); text-decoration: none; font-size: 0.9rem;"><i class="bi bi-arrow-left me-2"></i> Back to My Account</a>
    </div>
</div>

<div class="order-container">
    <div class="order-card">
        <!-- Banner -->
        <div class="status-banner">
            <div class="status-text">
                <h2>{{ $order->status }}</h2>
                <p>Placed on {{ $order->created_at->format('M d, Y') }}</p>
            </div>
            <div class="status-icon">
                @if($order->status == 'pending') <i class="bi bi-hourglass-split"></i>
                @elseif($order->status == 'processing') <i class="bi bi-gem"></i>
                @elseif($order->status == 'shipped') <i class="bi bi-truck"></i>
                @elseif($order->status == 'delivered') <i class="bi bi-box2-heart"></i>
                @else <i class="bi bi-info-circle"></i>
                @endif
            </div>
        </div>

        <!-- Timeline -->
        <div class="timeline-wrapper">
            <div class="timeline-steps">
                @php
                    $steps = ['pending', 'processing', 'shipped', 'delivered'];
                    $current_idx = array_search($order->status, $steps);
                    if($current_idx === false) $current_idx = -1;
                @endphp

                <div class="timeline-step {{ $current_idx >= 0 ? ($current_idx == 0 ? 'active' : 'completed') : '' }}">
                    <div class="step-circle"><i class="bi bi-check2"></i></div>
                    <div class="step-name">Order Received</div>
                </div>
                <div class="timeline-step {{ $current_idx >= 1 ? ($current_idx == 1 ? 'active' : 'completed') : '' }}">
                    <div class="step-circle"><i class="bi bi-gem"></i></div>
                    <div class="step-name">Processing</div>
                </div>
                <div class="timeline-step {{ $current_idx >= 2 ? ($current_idx == 2 ? 'active' : 'completed') : '' }}">
                    <div class="step-circle"><i class="bi bi-truck"></i></div>
                    <div class="step-name">Shipped</div>
                </div>
                <div class="timeline-step {{ $current_idx >= 3 ? ($current_idx == 3 ? 'active' : 'completed') : '' }}">
                    <div class="step-circle"><i class="bi bi-box2-heart"></i></div>
                    <div class="step-name">Delivered</div>
                </div>
            </div>
        </div>

        <!-- Grid -->
        <div class="details-grid">
            
            <!-- Items -->
            <div class="items-section">
                <h3 class="section-title">Order Items</h3>
                @foreach($order->items as $item)
                <div class="order-item">
                    <img src="{{ asset($item->product ? $item->product->main_image : 'assets/images/placeholder.jpg') }}" alt="{{ $item->product_name }}" class="order-item-img">
                    <div class="order-item-info">
                        <h4>{{ $item->product_name }}</h4>
                        <div class="order-item-sku">SKU: {{ $item->product ? $item->product->sku : 'N/A' }}</div>
                        <div class="order-item-price">${{ number_format($item->price) }} × {{ $item->quantity }}</div>
                        
                        @if($order->status == 'delivered' || $order->status == 'processing')
                            <a href="{{ route('collections.product', [$item->product->collection->slug ?? 'collection', $item->product->slug ?? 'product']) }}#reviews" class="btn-review">
                                <i class="bi bi-star me-1"></i> Write a Review
                            </a>
                        @endif
                    </div>
                </div>
                @endforeach
            </div>

            <!-- Info -->
            <div class="info-section">
                <h3 class="section-title">Order Information</h3>
                
                <div class="info-card">
                    <h5>Shipping Address</h5>
                    <p><strong>{{ $order->first_name }} {{ $order->last_name }}</strong></p>
                    <p style="color: var(--raj-grey);">{{ $order->email }}</p>
                    <p style="margin-top: 10px;">
                        {{ $order->address }}<br>
                        {{ $order->city }}, {{ $order->pincode }}<br>
                        India
                    </p>
                </div>

                @if($order->tracking_number)
                <div class="info-card tracking-card">
                    <div style="display: flex; justify-content: space-between; align-items: flex-start;">
                        <div>
                            <h5>{{ $order->courier_name }}</h5>
                            <div class="tracking-number">{{ $order->tracking_number }}</div>
                        </div>
                        <i class="bi bi-box-seam fs-2 text-success"></i>
                    </div>
                    @if($order->tracking_url)
                        <a href="{{ $order->tracking_url }}" target="_blank" class="btn-track">Track Shipment <i class="bi bi-box-arrow-up-right ms-2"></i></a>
                    @endif
                </div>
                @endif

                <div class="info-card">
                    <h5>Order Summary</h5>
                    <table class="summary-table">
                        <tr>
                            <td class="label">Subtotal</td>
                            <td class="amount">${{ number_format($order->total_amount + $order->discount_amount) }}</td>
                        </tr>
                        @if($order->discount_amount > 0)
                        <tr>
                            <td class="label">Discount ({{ $order->coupon_code }})</td>
                            <td class="amount" style="color: #27ae60;">- ${{ number_format($order->discount_amount) }}</td>
                        </tr>
                        @endif
                        <tr>
                            <td class="label">Shipping</td>
                            <td class="amount" style="color: var(--raj-gold);">Complimentary</td>
                        </tr>
                        <tr class="total-row">
                            <td>Total</td>
                            <td class="amount">${{ number_format($order->total_amount) }}</td>
                        </tr>
                    </table>
                    
                    <div style="margin-top: 20px; font-family: var(--font-accent); font-size: 0.8rem; color: var(--raj-grey); text-transform: uppercase; letter-spacing: 1px;">
                        Payment Method: <span style="color: var(--raj-maroon); font-weight: 500;">{{ str_replace('_', ' ', $order->payment_method) }}</span>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

@include('frontend.footer')
