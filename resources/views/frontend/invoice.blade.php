@php
    $total = $order->total_amount;
@endphp
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice_{{ $order->order_number }}</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700&family=Playfair+Display:wght@400;700&family=Outfit:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        :root {
            --royal-maroon: #0F1F17;
            --palace-gold: #333333;
            --sandstone: #fdfaf7;
        }

        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Outfit', sans-serif; color: #000000; background: #fff; line-height: 1.6; }

        .invoice-wrapper {
            max-width: 1000px;
            margin: 40px auto;
            padding: 60px;
            border: 1px solid #eee;
            position: relative;
        }

        /* Border Decoration */
        .invoice-wrapper::before {
            content: '';
            position: absolute;
            inset: 15px;
            border: 1px solid rgba(197, 160, 89, 0.3);
            pointer-events: none;
        }

        .header-top {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 60px;
            border-bottom: 2px solid var(--royal-maroon);
            padding-bottom: 30px;
        }

        .brand-identity h1 {
            font-family: 'Inter', serif;
            font-size: 1.8rem;
            letter-spacing: 4px;
            color: var(--royal-maroon);
            text-transform: uppercase;
        }

        .brand-identity p {
            font-size: 0.7rem;
            letter-spacing: 2px;
            color: var(--palace-gold);
            text-transform: uppercase;
            font-weight: 600;
        }

        .invoice-details { text-align: right; }
        .invoice-details h2 {
            font-family: 'Inter', serif;
            font-size: 2.2rem;
            color: var(--palace-gold);
            margin-bottom: 10px;
        }

        .meta-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 60px;
            margin-bottom: 60px;
        }

        .meta-block h3 {
            font-family: 'Inter', serif;
            font-size: 0.8rem;
            letter-spacing: 2px;
            color: var(--palace-gold);
            margin-bottom: 15px;
            border-bottom: 1px solid #eee;
            padding-bottom: 8px;
        }

        .meta-block p { font-size: 0.95rem; margin-bottom: 4px; }

        .items-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 40px;
        }

        .items-table th {
            background: var(--sandstone);
            text-align: left;
            padding: 15px;
            font-family: 'Inter', serif;
            font-size: 0.75rem;
            letter-spacing: 1px;
            border-top: 1px solid #eee;
            border-bottom: 2px solid var(--palace-gold);
        }

        .items-table td {
            padding: 20px 15px;
            border-bottom: 1px solid #f5f5f5;
        }

        .product-name {
            font-family: 'Inter', serif;
            font-size: 1.1rem;
            font-weight: 700;
            display: block;
        }

        .product-sku { font-size: 0.7rem; color: #888; text-transform: uppercase; }

        .totals-section {
            width: 350px;
            margin-left: auto;
        }

        .total-row {
            display: flex;
            justify-content: space-between;
            padding: 10px 0;
            font-size: 0.95rem;
        }

        .total-row.grand-total {
            border-top: 2px solid var(--palace-gold);
            margin-top: 10px;
            padding-top: 20px;
            font-family: 'Inter', serif;
            font-weight: 700;
            font-size: 1.3rem;
            color: var(--royal-maroon);
        }

        .footer-note {
            margin-top: 80px;
            padding-top: 30px;
            border-top: 1px dashed #eee;
            text-align: center;
            font-size: 0.85rem;
            color: #666;
        }

        .stamp-signature {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 60px;
        }

        .stamp {
            width: 120px;
            height: 120px;
            border: 2px double var(--palace-gold);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            font-family: 'Inter', serif;
            font-size: 0.6rem;
            color: var(--palace-gold);
            transform: rotate(-15deg);
            opacity: 0.8;
        }

        .signature {
            text-align: center;
            border-top: 1px solid #000000;
            padding-top: 10px;
            width: 200px;
        }

        @media print {
            body { background: #fff; }
            .invoice-wrapper { margin: 0; border: none; padding: 40px; }
            .no-print { display: none; }
        }

        .btn-print {
            position: fixed;
            bottom: 30px;
            right: 30px;
            background: var(--royal-maroon);
            color: #fff;
            border: none;
            padding: 15px 30px;
            font-family: 'Inter', serif;
            cursor: pointer;
            z-index: 1000;
            box-shadow: 0 10px 20px rgba(0,0,0,0.2);
        }
    </style>
</head>
<body>

    <button class="btn-print no-print" onclick="window.print()">Download PDF / Print</button>

    <div class="invoice-wrapper">
        <div class="header-top">
            <div class="brand-identity">
                <h1>Lexoria Diamond</h1>
                <p>Private Limited</p>
            </div>
            <div class="invoice-details">
                <h2>Invoice</h2>
                <p style="font-weight: 600;">#{{ $order->order_number }}</p>
                <p style="font-size: 0.85rem; color: #888;">{{ $order->created_at->format('d F, Y') }}</p>
            </div>
        </div>

        <div class="meta-grid">
            <div class="meta-block">
                <h3>Billed To</h3>
                <p><strong>{{ $order->first_name }} {{ $order->last_name }}</strong></p>
                <p>{{ $order->address }}</p>
                <p>{{ $order->city }}, {{ $order->pincode }}</p>
                <p>India</p>
                <p>Email: {{ $order->email }}</p>
                <p>Contact: {{ $order->mobile }}</p>
            </div>
                <p>Support: +91 98765 43210</p>
                @if($order->gst_number)
                    <p style="margin-top: 10px; color: var(--palace-gold); font-weight: 700;">Customer GST: {{ $order->gst_number }}</p>
                @endif
            </div>
        </div>

        <table class="items-table">
            <thead>
                <tr>
                    <th>Item Description</th>
                    <th style="text-align: center;">Qty</th>
                    <th style="text-align: right;">Unit Price</th>
                    <th style="text-align: right;">Valuation</th>
                </tr>
            </thead>
            <tbody>
                @foreach($order->items as $item)
                <tr>
                    <td>
                        <span class="product-name">{{ $item->product_name }}</span>
                        <span class="product-sku">SKU: {{ $item->product ? $item->product->sku : 'MASTERPIECE' }}</span>
                    </td>
                    <td style="text-align: center;">{{ $item->quantity }}</td>
                    <td style="text-align: right;">${{ number_format($item->price) }}</td>
                    <td style="text-align: right;">${{ number_format($item->subtotal) }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <div class="totals-section">
            <div class="total-row">
                <span>Subtotal</span>
                <span>${{ number_format($order->items->sum('subtotal')) }}</span>
            </div>
            @if($order->discount_amount > 0)
                <div class="total-row">
                    <span>Discount ({{ $order->coupon_code }})</span>
                    <span style="color: #c62828;">-${{ number_format($order->discount_amount) }}</span>
                </div>
            @endif
            <div class="total-row">
                <span>Insured Shipping</span>
                <span style="color: var(--palace-gold);">Complimentary</span>
            </div>
            <div class="total-row">
                <span>Tax (GST 3%)</span>
                <span>${{ number_format($order->tax_amount) }}</span>
            </div>
            <div class="total-row grand-total">
                <span>Total Due</span>
                <span>${{ number_format($order->total_amount) }}</span>
            </div>
        </div>

        <div class="stamp-signature">
            <div class="stamp">
                LEXORIA DIAMOND<br>
                ESTD 1995<br>
                VERIFIED
            </div>
            <div class="signature">
                <p style="font-size: 0.7rem; color: #888; margin-bottom: 5px;">Authorized Signatory</p>
                <p style="font-family: 'Inter', serif; font-weight: 700;">For Lexoria Diamond</p>
            </div>
        </div>

        <div class="footer-note">
            <p style="font-family: 'Inter', serif; font-style: italic; font-size: 1rem; color: var(--royal-maroon); margin-bottom: 10px;">
                "Thank you for choosing Lexoria. Every piece tells a story, and yours is now eternal."
            </p>
            <p style="font-size: 0.7rem; color: #aaa;">This is a computer-generated invoice and does not require a physical signature for verification.</p>
        </div>
    </div>

</body>
</html>

