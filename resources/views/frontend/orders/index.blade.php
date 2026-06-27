@include('frontend.navbar')

<!-- Premium Fonts -->
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700;900&family=Playfair+Display:wght@400;700;900&family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">

<style>
    :root {
        --rajwadi-maroon: #000000;
        --rajwadi-gold: #333333;
        --rajwadi-cream: #fdf9f5;
        --rajwadi-sand: #f2e9de;
        --rajwadi-dark: #000000;
    }

    body {
        background-color: var(--rajwadi-cream);
        font-family: 'Inter', sans-serif;
        color: var(--rajwadi-dark);
        background-image: url("data:image/svg+xml,%3Csvg width='100' height='100' viewBox='0 0 100 100' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M50 50 L55 40 L60 50 L55 60 Z' fill='%23b58d55' fill-opacity='0.04'/%3E%3C/svg%3E");
    }

    .order-treasury-container {
        max-width: 95%;
        margin: 100px auto;
        padding: 0 40px;
    }

    .rajwadi-page-header {
        text-align: center;
        margin-bottom: 80px;
        position: relative;
    }

    .rajwadi-page-header .ornament {
        color: var(--rajwadi-gold);
        font-size: 2rem;
        margin-bottom: 10px;
        display: block;
    }

    .rajwadi-page-header h1 {
        font-family: 'Inter', serif;
        font-size: 3rem;
        font-weight: 900;
        color: var(--rajwadi-maroon);
        letter-spacing: 5px;
        margin: 0;
        text-transform: uppercase;
    }

    .rajwadi-page-header .divider {
        width: 150px;
        height: 2px;
        background: linear-gradient(90deg, transparent, var(--rajwadi-gold), transparent);
        margin: 20px auto;
    }

    .rajwadi-card {
        background: white;
        border: 2px solid var(--rajwadi-sand);
        margin-bottom: 50px;
        position: relative;
        box-shadow: 0 20px 40px rgba(90, 25, 25, 0.05);
    }

    .rajwadi-card-header {
        background: var(--rajwadi-maroon);
        padding: 25px 40px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        border-bottom: 4px solid var(--rajwadi-gold);
    }

    .mandate-ref label {
        display: block;
        font-size: 0.6rem;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: 2px;
        color: rgba(255, 255, 255, 0.6);
        margin-bottom: 5px;
    }

    .mandate-ref .val {
        font-family: 'Inter', serif;
        font-size: 1.1rem;
        color: white;
        font-weight: 700;
        letter-spacing: 1px;
    }

    .mandate-meta {
        display: flex;
        gap: 40px;
    }

    .meta-box label {
        display: block;
        font-size: 0.6rem;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: 2px;
        color: rgba(255, 255, 255, 0.6);
        margin-bottom: 5px;
    }

    .meta-box .val {
        font-family: 'Inter', sans-serif;
        font-size: 0.9rem;
        color: var(--rajwadi-gold);
        font-weight: 700;
    }

    .status-badge {
        background: white;
        padding: 5px 15px;
        font-size: 0.65rem;
        font-weight: 900;
        text-transform: uppercase;
        letter-spacing: 1.5px;
        color: var(--rajwadi-maroon);
        border: 1px solid var(--rajwadi-gold);
    }

    .rajwadi-card-body {
        padding: 40px;
    }

    .product-list {
        display: flex;
        flex-direction: column;
        gap: 30px;
    }

    .product-row {
        display: flex;
        gap: 30px;
        align-items: center;
    }

    .product-img-box {
        width: 110px;
        height: 110px;
        padding: 10px;
        background: var(--rajwadi-cream);
        border: 1px solid var(--rajwadi-sand);
        position: relative;
    }

    .product-img-box img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .product-info h4 {
        font-family: 'Inter', serif;
        font-size: 1.4rem;
        font-weight: 700;
        margin: 0 0 8px 0;
        color: var(--rajwadi-maroon);
    }

    .product-info p {
        margin: 0 0 15px 0;
        font-size: 0.85rem;
        color: #777;
    }

    .btn-appraisal {
        display: inline-flex;
        align-items: center;
        gap: 10px;
        color: var(--rajwadi-gold);
        text-decoration: none;
        font-size: 0.75rem;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: 2px;
        transition: all 0.3s;
    }

    .btn-appraisal:hover {
        color: var(--rajwadi-maroon);
        transform: translateX(5px);
    }

    .rajwadi-card-footer {
        padding: 25px 40px;
        background: #faf7f2;
        border-top: 1px solid var(--rajwadi-sand);
        display: flex;
        justify-content: flex-end;
        gap: 20px;
    }

    .btn-rajwadi {
        padding: 14px 30px;
        font-family: 'Inter', serif;
        font-size: 0.8rem;
        font-weight: 700;
        letter-spacing: 2px;
        text-decoration: none;
        transition: all 0.4s;
        text-transform: uppercase;
    }

    .btn-rajwadi-outline {
        border: 1px solid var(--rajwadi-maroon);
        color: var(--rajwadi-maroon);
    }

    .btn-rajwadi-outline:hover {
        background: var(--rajwadi-maroon);
        color: var(--rajwadi-gold);
    }

    .btn-rajwadi-filled {
        background: var(--rajwadi-maroon);
        color: var(--rajwadi-gold);
        border: 1px solid var(--rajwadi-maroon);
    }

    .btn-rajwadi-filled:hover {
        background: transparent;
        color: var(--rajwadi-maroon);
    }

    @media (max-width: 768px) {
        .rajwadi-card-header { flex-direction: column; align-items: flex-start; gap: 20px; }
        .mandate-meta { gap: 20px; width: 100%; justify-content: space-between; }
        .product-row { flex-direction: column; align-items: flex-start; }
        .rajwadi-card-footer { flex-direction: column; }
        .btn-rajwadi { text-align: center; }
    }
</style>

<div class="order-treasury-container">
    <div class="rajwadi-page-header">
        <span class="ornament">â¦</span>
        <h1>Order Treasury</h1>
        <div class="divider"></div>
        <p class="text-muted italic">Explore your chronicle of royal acquisitions</p>
    </div>

    @if($orders->count() > 0)
        @foreach($orders as $order)
            <div class="rajwadi-card">
                <div class="rajwadi-card-header">
                    <div class="mandate-ref">
                        <label>Mandate Reference</label>
                        <div class="val">#{{ $order->order_number }}</div>
                    </div>
                    
                    <div class="mandate-meta">
                        <div class="meta-box">
                            <label>Acquired On</label>
                            <div class="val">{{ $order->created_at->format('d M, Y') }}</div>
                        </div>
                        <div class="meta-box">
                            <label>Valuation</label>
                            <div class="val">${{ number_format($order->total_amount) }}</div>
                        </div>
                    </div>

                    <div class="mandate-status">
                        <span class="status-badge">
                            {{ $order->status }}
                        </span>
                    </div>
                </div>

                <div class="rajwadi-card-body">
                    <div class="product-list">
                        @foreach($order->items as $item)
                            <div class="product-row">
                                <div class="product-img-box">
                                    <img src="{{ asset($item->product ? $item->product->image : 'assets/images/placeholder.jpg') }}" alt="">
                                </div>
                                <div class="product-info">
                                    <h4>{{ $item->product_name }}</h4>
                                    <p>Qty: {{ $item->quantity }} â€¢ Val: ${{ number_format($item->price) }}</p>
                                    
                                    @if($order->status == 'delivered' || $order->status == 'processing')
                                        <a href="{{ route('collections.product', [$item->product->collection->slug, $item->product->slug]) }}#reviews" class="btn-appraisal">
                                            <i class="bi bi-award"></i> Share Appraisal
                                        </a>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>

                    @if($order->tracking_number)
                        <div style="margin-top: 40px; padding: 25px 35px; background: rgba(0, 0, 0, 0.05); border-left: 4px solid var(--rajwadi-gold); display: flex; align-items: center; gap: 25px;">
                            <i class="bi bi-truck fs-3 text-muted"></i>
                            <div>
                                <div style="font-size: 0.65rem; text-transform: uppercase; letter-spacing: 1.5px; color: #999; font-weight: 800; margin-bottom: 5px;">Logistics Mandate ({{ $order->courier_name }})</div>
                                <div style="font-family: 'Inter', serif; font-size: 1.1rem; font-weight: 700; color: var(--rajwadi-maroon);">{{ $order->tracking_number }}</div>
                            </div>
                            @if($order->tracking_url)
                                <a href="{{ $order->tracking_url }}" target="_blank" style="margin-left: auto; background: var(--rajwadi-maroon); color: white; padding: 10px 25px; font-size: 0.7rem; font-weight: 700; text-decoration: none; letter-spacing: 1px; text-transform: uppercase;">Track Live</a>
                            @endif
                        </div>
                    @endif
                </div>

                <div class="rajwadi-card-footer">
                    <a href="{{ route('orders.show', $order->order_number) }}" class="btn-rajwadi btn-rajwadi-outline">View Journey</a>
                    <a href="{{ route('order.invoice', $order->id) }}" target="_blank" class="btn-rajwadi btn-rajwadi-filled">Royal Receipt</a>
                </div>
            </div>
        @endforeach

        <div class="pagination-wrapper">
            {{ $orders->links() }}
        </div>
    @else
        <div class="text-center py-5" style="border: 2px dashed var(--rajwadi-gold); background: white; padding: 100px !important;">
            <span style="font-size: 4rem; color: var(--rajwadi-gold); opacity: 0.3; display: block; margin-bottom: 20px;">ðŸ“œ</span>
            <h2 style="font-family: 'Inter', serif; color: var(--rajwadi-maroon);">Your Treasury is Empty</h2>
            <p class="text-muted mb-4">You haven't acquired any masterpieces yet.</p>
            <a href="{{ route('collections') }}" class="btn-rajwadi btn-rajwadi-filled">Explore Collections</a>
        </div>
    @endif
</div>

@include('frontend.footer')


