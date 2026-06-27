@include('frontend.navbar')

<!-- Google Fonts -->
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700&family=Playfair+Display:wght@400;700&family=Outfit:wght@300;400;600&display=swap" rel="stylesheet">

<style>
    :root {
        --royal-maroon: #0F1F17;
        --palace-gold: #333333;
        --sandstone: #f4ece2;
        --silk-white: #ffffff;
    }

    body {
        background-color: var(--sandstone);
        background-image:
            radial-gradient(ellipse at top right, rgba(0, 0, 0, 0.12) 0%, transparent 60%),
            radial-gradient(ellipse at bottom left, rgba(90, 25, 25, 0.08) 0%, transparent 50%);
        font-family: 'Outfit', sans-serif;
        color: var(--royal-maroon);
    }

    .success-page {
        padding: 80px 20px;
        background-image: 
            url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M30 0L60 30L30 60L0 30Z' fill='none' stroke='%235a1919' stroke-opacity='0.03' stroke-width='1'/%3E%3Ccircle cx='30' cy='30' r='10' fill='none' stroke='%23b58d55' stroke-opacity='0.04' stroke-width='1'/%3E%3C/svg%3E");
    }

    .invoice-container {
        max-width: 900px;
        margin: 0 auto;
        background: #fff;
        border: 1px solid rgba(197, 160, 89, 0.3);
        box-shadow: 0 30px 60px rgba(61, 10, 10, 0.1);
        position: relative;
        overflow: hidden;
    }

    .invoice-container::before {
        content: '';
        position: absolute;
        top: 0; left: 0; right: 0;
        height: 8px;
        background: linear-gradient(90deg, var(--royal-maroon), var(--palace-gold), var(--royal-maroon));
    }

    .invoice-header {
        padding: 50px;
        text-align: center;
        background: var(--royal-maroon);
        color: #fff;
        border-bottom: 4px double var(--palace-gold);
    }

    .success-icon {
        font-size: 4rem;
        color: var(--palace-gold);
        margin-bottom: 20px;
    }

    .invoice-header h1 {
        font-family: 'Inter', serif;
        font-size: 2.2rem;
        letter-spacing: 3px;
        margin-bottom: 10px;
    }

    .order-id {
        font-size: 1.1rem;
        opacity: 0.8;
        letter-spacing: 1px;
    }

    .invoice-body {
        padding: 50px;
    }

    .invoice-meta {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 40px;
        margin-bottom: 50px;
        padding-bottom: 30px;
        border-bottom: 1px dashed var(--palace-gold);
    }

    .meta-block h3 {
        font-family: 'Inter', serif;
        font-size: 1.2rem;
        margin-bottom: 15px;
        color: var(--palace-gold);
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    .meta-block p {
        margin: 5px 0;
        font-size: 0.95rem;
        line-height: 1.6;
    }

    .invoice-table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 40px;
    }

    .invoice-table th {
        text-align: left;
        padding: 15px;
        background: var(--sandstone);
        font-family: 'Inter', serif;
        font-size: 0.8rem;
        letter-spacing: 1px;
        border-bottom: 2px solid var(--palace-gold);
    }

    .invoice-table td {
        padding: 20px 15px;
        border-bottom: 1px solid rgba(197, 160, 89, 0.1);
    }

    .product-cell {
        display: flex;
        align-items: center;
        gap: 15px;
    }

    .product-cell img {
        width: 60px;
        height: 60px;
        object-fit: cover;
        border: 1px solid var(--palace-gold);
    }

    .product-info h4 {
        margin: 0;
        font-family: 'Inter', serif;
        font-size: 1.05rem;
    }

    .product-info span {
        font-size: 0.75rem;
        color: var(--palace-gold);
        text-transform: uppercase;
    }

    .invoice-totals {
        width: 300px;
        margin-left: auto;
    }

    .total-row {
        display: flex;
        justify-content: space-between;
        padding: 10px 0;
    }

    .total-row.grand-total {
        margin-top: 10px;
        padding-top: 20px;
        border-top: 2px solid var(--palace-gold);
        font-family: 'Inter', serif;
        font-weight: 700;
        font-size: 1.2rem;
    }

    .invoice-footer {
        padding: 40px 50px;
        background: var(--sandstone);
        text-align: center;
        border-top: 1px solid rgba(197, 160, 89, 0.2);
    }

    .btn-action {
        display: inline-block;
        padding: 15px 35px;
        margin: 10px;
        text-decoration: none;
        font-family: 'Inter', serif;
        font-weight: 700;
        font-size: 0.85rem;
        letter-spacing: 2px;
        transition: all 0.3s;
        cursor: pointer;
    }

    .btn-print {
        background: var(--royal-maroon);
        color: #fff;
        border: 1px solid var(--royal-maroon);
    }

    .btn-continue {
        background: transparent;
        color: var(--royal-maroon);
        border: 1px solid var(--royal-maroon);
    }

    .btn-print:hover {
        background: var(--palace-gold);
        border-color: var(--palace-gold);
    }

    .btn-continue:hover {
        background: var(--royal-maroon);
        color: #fff;
    }

    @media print {
        @page { size: auto;  margin: 0mm; }
        .success-page { padding: 0; }
        .invoice-footer, .frontend-navbar, footer { display: none !important; }
        .invoice-container { box-shadow: none; border: none; }
    }

    /* ===== MOBILE RESPONSIVE ===== */
    @media (max-width: 768px) {
        .success-page {
            padding: 40px 10px;
        }

        .invoice-header {
            padding: 40px 20px;
        }

        .invoice-header h1 {
            font-size: 1.6rem;
        }

        .success-icon {
            font-size: 3rem;
        }

        .invoice-body {
            padding: 30px 20px;
        }

        .invoice-meta {
            grid-template-columns: 1fr;
            gap: 25px;
            text-align: center !important;
        }

        .meta-block {
            text-align: center !important;
        }

        .invoice-table th:nth-child(2),
        .invoice-table td:nth-child(2) {
            display: none; /* Hide Qty on mobile to save space */
        }

        .product-cell {
            gap: 10px;
        }

        .product-cell img {
            width: 50px;
            height: 50px;
        }

        .product-info h4 {
            font-size: 0.9rem;
        }

        .product-info span {
            font-size: 0.65rem;
        }

        .invoice-totals {
            width: 100%;
            margin-top: 30px;
        }

        .total-row {
            font-size: 0.9rem;
        }

        .total-row.grand-total {
            font-size: 1.1rem;
        }

        .invoice-footer {
            padding: 30px 20px;
        }

        .btn-action {
            width: 100%;
            margin: 10px 0;
            padding: 15px 20px;
            font-size: 0.75rem;
        }
    }
</style>

<main class="success-page">
    <div class="invoice-container">
        <!-- Royal Header -->
        <div class="invoice-header">
            <div class="success-icon">
                <i class="bi bi-check-circle-fill"></i>
            </div>
            <h1>Royal Mandate Issued</h1>
            <p class="order-id">Order Reference: {{ $order->order_number }}</p>
            <p style="margin-top: 10px; font-size: 0.9rem; opacity: 0.8;">{{ $order->created_at->format('d M Y, h:i A') }}</p>
        </div>

        <div class="invoice-body">
            <!-- Delivery & Billing -->
            <div class="invoice-meta">
                <div class="meta-block">
                    <h3>Imperial Recipient</h3>
                    <p><strong>{{ $order->first_name }} {{ $order->last_name }}</strong></p>
                    <p>{{ $order->address }}</p>
                    <p>{{ $order->city }}, {{ $order->pincode }}</p>
                    <p>India</p>
                </div>
                <div class="meta-block" style="text-align: right;">
                    <h3>Payment Mandate</h3>
                    <p><strong>Method:</strong> {{ strtoupper(str_replace('_', ' ', $order->payment_method)) }}</p>
                    <p><strong>Status:</strong> {{ ucfirst($order->status) }}</p>
                    <p><strong>Currency:</strong> USD ($)</p>
                </div>
            </div>

            @if($order->payment_method == 'bank_transfer')
            <!-- Bank Details for High Value Acquisitions -->
            <div style="background: var(--sandstone); padding: 30px; border: 1px solid var(--palace-gold); margin-bottom: 50px; border-radius: 4px; position: relative;">
                <div style="font-family: 'Inter', serif; font-size: 0.9rem; letter-spacing: 2px; color: var(--royal-maroon); margin-bottom: 20px; text-align: center; font-weight: 700;">
                    Bank Transfer Instructions (RTGS / NEFT)
                </div>
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                    <div>
                        <p style="font-size: 0.75rem; text-transform: uppercase; color: var(--palace-gold); margin-bottom: 5px;">Bank Name</p>
                        <p style="font-weight: 600;">HDFC BANK</p>
                    </div>
                    <div>
                        <p style="font-size: 0.75rem; text-transform: uppercase; color: var(--palace-gold); margin-bottom: 5px;">Account Name</p>
                        <p style="font-weight: 600;">LEXORIA DIAMOND PRIVATE LIMITED</p>
                    </div>
                    <div>
                        <p style="font-size: 0.75rem; text-transform: uppercase; color: var(--palace-gold); margin-bottom: 5px;">Account Number</p>
                        <p style="font-weight: 600;">50200012345678</p>
                    </div>
                    <div>
                        <p style="font-size: 0.75rem; text-transform: uppercase; color: var(--palace-gold); margin-bottom: 5px;">IFSC Code</p>
                        <p style="font-weight: 600;">HDFC0001234</p>
                    </div>
                </div>
                <p style="font-size: 0.8rem; margin-top: 20px; font-style: italic; text-align: center; color: var(--royal-maroon);">
                    * Please include your Order Reference <strong>{{ $order->order_number }}</strong> in the transfer remarks. Your acquisition will be processed once the valuation is confirmed.
                </p>
            </div>
            @endif

            <!-- Masterpiece Table -->
            <table class="invoice-table">
                <thead>
                    <tr>
                        <th>The Masterpiece</th>
                        <th style="text-align: center;">Qty</th>
                        <th style="text-align: right;">Valuation</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($order->items as $item)
                    <tr>
                        <td>
                            <div class="product-cell">
                                @php
                                    $image = $item->product ? $item->product->image : 'assets/images/placeholder.jpg';
                                @endphp
                                <img src="{{ asset($image) }}" alt="{{ $item->product_name }}">
                                <div class="product-info">
                                    <h4>{{ $item->product_name }}</h4>
                                    <span>Treasury SKU: {{ $item->product ? $item->product->sku : strtoupper(substr(md5($item->product_name), 0, 8)) }}</span>
                                </div>
                            </div>
                        </td>
                        <td style="text-align: center;">{{ $item->quantity }}</td>
                        <td style="text-align: right;">${{ number_format($item->subtotal) }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            <!-- Grand Totals -->
            <div class="invoice-totals">
                <div class="total-row">
                    <span>Royal Subtotal</span>
                    <span>${{ number_format($order->total_amount + $order->discount_amount) }}</span>
                </div>
                @if($order->discount_amount > 0)
                <div class="total-row" style="color: #27ae60;">
                    <span>Mandate Discount ({{ $order->coupon_code }})</span>
                    <span>- ${{ number_format($order->discount_amount) }}</span>
                </div>
                @endif
                <div class="total-row">
                    <span>Sacred Delivery (Insured)</span>
                    <span style="color: var(--palace-gold);">Complimentary</span>
                </div>
                <div class="total-row grand-total">
                    <span>Total Valuation</span>
                    <span>${{ number_format($order->total_amount) }}</span>
                </div>
            </div>
        </div>

        <!-- Palace Footer -->
        <div class="invoice-footer">
            <div class="mb-4 p-3 bg-white border border-warning-subtle rounded-3 shadow-sm">
                <h5 class="mb-2" style="font-family: 'Inter', serif; color: #000000;">Your Appraisal Matters</h5>
                <p class="text-muted small mb-0">Once you receive your treasures, we invite you to share your royal experience on each product's page.</p>
            </div>
            <p style="font-family: 'Inter', serif; font-style: italic; margin-bottom: 30px;">
                "Your collection is being curated and secured for delivery. May it bring the light of the sun to your house."
            </p>
            <div class="action-buttons">
                <a href="{{ route('order.invoice', $order->order_number) }}" target="_blank" class="btn-action btn-print text-decoration-none">Download Royal Receipt</a>
                <a href="{{ route('collections') }}" class="btn-action btn-continue">Continue Curation</a>
            </div>
        </div>
    </div>
</main>

@include('frontend.footer')


