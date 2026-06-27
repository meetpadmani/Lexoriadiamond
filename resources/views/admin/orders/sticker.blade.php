<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Professional Order Mandate - {{ $order->order_number }}</title>
    
    <!-- Premium Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700;800;900&display=swap" rel="stylesheet">
    
    <!-- QR Code & Barcode Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/jsbarcode@3.11.0/dist/JsBarcode.all.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js"></script>

    <style>
        /* 4x6 Inch Thermal Label Print Settings */
        @page {
            size: 4in 6in;
            margin: 0;
        }
        
        * { box-sizing: border-box; }
        
        body {
            margin: 0;
            padding: 0;
            background: #e9ecef;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            font-family: 'Inter', sans-serif;
            color: #000;
            -webkit-font-smoothing: antialiased;
        }

        .shipping-label {
            width: 4in;
            height: 6in;
            background: #fff;
            padding: 2mm;
            display: flex;
            flex-direction: column;
            border: 2px solid #000;
            overflow: hidden;
            position: relative;
        }

        /* Generic Utility */
        .border-bottom { border-bottom: 2px solid #000; }
        .border-right { border-right: 2px solid #000; }
        .flex-row { display: flex; width: 100%; }

        /* Row 1: Carrier & Payment */
        .r1-carrier {
            width: 65%;
            padding: 2mm 3mm;
            display: flex;
            align-items: center;
        }
        .courier-text {
            font-size: 16pt;
            font-weight: 900;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        .r1-payment {
            width: 35%;
            background: #000;
            color: #fff;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 2mm;
            text-align: center;
        }
        .payment-title {
            font-size: 10pt;
            font-weight: 900;
            line-height: 1.1;
        }
        .payment-amt {
            font-size: 14pt;
            font-weight: 900;
            margin-top: 1mm;
        }

        /* Row 2: Delivery Address */
        .r2-address {
            padding: 3mm;
            height: 22%;
            display: flex;
            flex-direction: column;
            position: relative;
        }
        .to-label {
            font-size: 8pt;
            font-weight: 800;
            text-decoration: underline;
            margin-bottom: 1mm;
        }
        .customer-name {
            font-size: 12pt;
            font-weight: 900;
            text-transform: uppercase;
        }
        .customer-address {
            font-size: 9pt;
            font-weight: 600;
            margin-top: 1mm;
            line-height: 1.2;
            width: 75%;
        }
        .customer-phone {
            font-size: 10pt;
            font-weight: 800;
            margin-top: 1.5mm;
        }
        .pincode-box {
            position: absolute;
            bottom: 3mm;
            right: 3mm;
            text-align: right;
        }
        .pincode-label {
            font-size: 7pt;
            font-weight: 700;
        }
        .pincode-val {
            font-size: 18pt;
            font-weight: 900;
            letter-spacing: 1px;
            line-height: 1;
        }

        /* Row 3: Barcode */
        .r3-barcode {
            padding: 4mm 2mm;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 22%;
        }
        .r3-barcode svg {
            width: 95%;
            max-height: 60px;
        }
        .awb-text {
            font-size: 12pt;
            font-weight: 900;
            margin-top: 2mm;
            letter-spacing: 1px;
        }

        /* Row 4: Order Details */
        .r4-details {
            display: flex;
            height: 16%;
        }
        .details-col {
            padding: 2mm;
            font-size: 7pt;
            line-height: 1.4;
        }
        .details-col.w-60 { width: 60%; }
        .details-col.w-40 { width: 40%; }
        
        .detail-item {
            display: flex;
            justify-content: space-between;
            border-bottom: 1px dashed #ccc;
            padding-bottom: 0.5mm;
            margin-bottom: 0.5mm;
        }
        .detail-item strong { font-weight: 800; }

        /* Row 5: Return Address & QR */
        .r5-footer {
            display: flex;
            height: 20%;
            border-top: 2px solid #000;
            flex-grow: 1;
        }
        .return-address {
            width: 70%;
            padding: 2mm;
        }
        .return-label {
            font-size: 7pt;
            font-weight: 800;
            margin-bottom: 1mm;
        }
        .return-text {
            font-size: 7pt;
            font-weight: 600;
            line-height: 1.2;
        }
        .qr-box {
            width: 30%;
            padding: 2mm;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }
        .qr-label {
            font-size: 6pt;
            font-weight: 800;
            text-align: center;
            margin-bottom: 1mm;
        }

        .print-btn {
            position: fixed;
            top: 20px;
            right: 20px;
            background: #000;
            color: #fff;
            padding: 12px 24px;
            border: none;
            border-radius: 8px;
            font-weight: bold;
            cursor: pointer;
            z-index: 1000;
            box-shadow: 0 4px 12px rgba(0,0,0,0.2);
        }
        .print-btn:hover { background: #333; }

        @media print {
            body { 
                background: #fff; 
                display: block;
                height: 100%;
            }
            .shipping-label { 
                border: none; 
                margin: 0;
                padding: 0;
                width: 4in;
                height: 6in;
                page-break-after: always;
            }
            .print-btn { display: none !important; }
        }
    </style>
</head>
<body>

    <button onclick="window.print()" class="print-btn" id="printBtn">Print Mandate Label</button>

    <div class="shipping-label">
        
        <!-- Row 1: Carrier & Payment -->
        <div class="flex-row border-bottom">
            <div class="r1-carrier border-right">
                <span class="courier-text">{{ $order->courier_name ?? 'CARRIER PENDING' }}</span>
            </div>
            <div class="r1-payment">
                <span class="payment-title">{{ $order->payment_method == 'cod' ? 'CASH ON' : 'PREPAID' }}</span>
                <span class="payment-title">{{ $order->payment_method == 'cod' ? 'DELIVERY' : 'ORDER' }}</span>
                @if($order->payment_method == 'cod')
                <span class="payment-amt">${{ number_format($order->total_amount) }}</span>
                @endif
            </div>
        </div>

        <!-- Row 2: Delivery Address -->
        <div class="r2-address border-bottom">
            <div class="to-label">SHIPPING TO:</div>
            <div class="customer-name">{{ strtoupper($order->first_name) }} {{ strtoupper($order->last_name) }}</div>
            <div class="customer-address">
                {{ $order->address }}<br>
                {{ strtoupper($order->city) }}
            </div>
            <div class="customer-phone">Ph: {{ $order->mobile }}</div>
            
            <div class="pincode-box">
                <div class="pincode-label">PINCODE</div>
                <div class="pincode-val">{{ $order->pincode }}</div>
            </div>
        </div>

        <!-- Row 3: Barcode -->
        <div class="r3-barcode border-bottom">
            <svg id="barcode"></svg>
            <div class="awb-text">AWB: {{ $order->tracking_number ?? 'PENDING' }}</div>
        </div>

        <!-- Row 4: Order Details -->
        <div class="flex-row border-bottom r4-details">
            <div class="details-col w-60 border-right">
                <div class="detail-item">
                    <span>Order Ref:</span>
                    <strong>{{ $order->order_number }}</strong>
                </div>
                <div class="detail-item">
                    <span>Order Date:</span>
                    <strong>{{ $order->created_at->format('d M Y') }}</strong>
                </div>
                <div class="detail-item">
                    <span>Invoice Value:</span>
                    <strong>${{ number_format($order->total_amount) }}</strong>
                </div>
                <div class="detail-item" style="border:none;">
                    <span>Seller:</span>
                    <strong>Lexoria Diamond</strong>
                </div>
            </div>
            <div class="details-col w-40">
                <div style="font-weight: 800; margin-bottom: 1mm; text-decoration: underline;">Items Included:</div>
                @foreach($order->items->take(3) as $item)
                <div style="margin-bottom: 0.5mm;">
                    {{ $item->quantity }}x {{ Str::limit($item->product_name, 20) }}
                </div>
                @endforeach
                @if($order->items->count() > 3)
                <div style="font-style: italic;">+ {{ $order->items->count() - 3 }} more item(s)</div>
                @endif
            </div>
        </div>

        <!-- Row 5: Footer -->
        <div class="r5-footer">
            <div class="return-address border-right">
                <div class="return-label">Return Address:</div>
                <div class="return-text">
                    Lexoria Diamond Studio<br>
                    Royal Palace Complex, Near Diamond Hub<br>
                    Surat, Gujarat - 395006<br>
                    GSTIN: 24AAACB1234A1Z5
                </div>
            </div>
            <div class="qr-box">
                <div class="qr-label">SCAN TO TRACK</div>
                <div id="qrcode"></div>
            </div>
        </div>
    </div>

    <script>
        // Hide print button if in iframe
        if (window.self !== window.top) {
            document.getElementById('printBtn').style.display = 'none';
            document.body.style.padding = '0';
            document.body.style.minHeight = 'auto';
            document.body.style.background = 'transparent';
        }

        // Generate Barcode using Tracking Number (if exists) or Order Number
        JsBarcode("#barcode", "{{ $order->tracking_number ? $order->tracking_number : $order->order_number }}", {
            format: "CODE128",
            lineColor: "#000",
            width: 2.2,
            height: 70,
            displayValue: false,
            margin: 0
        });

        // Generate QR Code
        var qrcode = new QRCode(document.getElementById("qrcode"), {
            text: "{{ route('order.tracking', $order->order_number) }}",
            width: 55,
            height: 55,
            colorDark : "#000000",
            colorLight : "#ffffff",
            correctLevel : QRCode.CorrectLevel.H
        });
    </script>
</body>
</html>
