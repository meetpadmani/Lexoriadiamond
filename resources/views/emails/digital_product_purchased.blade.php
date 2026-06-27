<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Your Digital Asset</title>
    <style>
        body {
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
            background-color: #fdfaf7;
            margin: 0;
            padding: 0;
            color: #0F1F17;
        }
        .email-wrapper {
            width: 100%;
            background-color: #fdfaf7;
            padding: 40px 0;
        }
        .email-content {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            border: 1px solid #e9ecef;
            border-top: 4px solid #333333;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 10px 25px rgba(0,0,0,0.05);
        }
        .header {
            text-align: center;
            padding: 40px 20px;
            background-color: #000000;
            color: #ffffff;
        }
        .header h1 {
            margin: 0;
            font-size: 24px;
            letter-spacing: 2px;
            text-transform: uppercase;
            color: #b58d55;
        }
        .body {
            padding: 40px;
        }
        .body h2 {
            margin-top: 0;
            font-size: 20px;
            color: #0F1F17;
        }
        .body p {
            font-size: 16px;
            line-height: 1.6;
            color: #555555;
            margin-bottom: 20px;
        }
        .product-list {
            list-style: none;
            padding: 0;
            margin: 30px 0;
            border-top: 1px solid #eeeeee;
            border-bottom: 1px solid #eeeeee;
        }
        .product-item {
            padding: 20px 0;
            display: flex;
            align-items: center;
            border-bottom: 1px solid #eeeeee;
        }
        .product-item:last-child {
            border-bottom: none;
        }
        .product-name {
            font-weight: bold;
            font-size: 16px;
            color: #0F1F17;
            flex-grow: 1;
        }
        .btn {
            display: inline-block;
            background-color: #333333;
            color: #b58d55 !important;
            text-decoration: none;
            padding: 15px 30px;
            border-radius: 4px;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 1px;
            font-size: 14px;
            text-align: center;
            margin-top: 20px;
        }
        .footer {
            text-align: center;
            padding: 20px;
            font-size: 12px;
            color: #888888;
            background-color: #fafafa;
            border-top: 1px solid #eeeeee;
        }
    </style>
</head>
<body>
    <div class="email-wrapper">
        <div class="email-content">
            <div class="header">
                <h1>Lexoria Diamond</h1>
                <p style="margin: 10px 0 0; font-size: 14px; letter-spacing: 4px; text-transform: uppercase;">Your Digital Asset is Ready</p>
            </div>
            
            <div class="body">
                <h2>Dear {{ $order->first_name }},</h2>
                <p>Thank you for your purchase. We are delighted to inform you that your digital asset is now ready for download.</p>
                <p>Your order number is <strong>{{ $order->order_number }}</strong>.</p>
                
                <div style="text-align: center; margin: 40px 0;">
                    <p style="margin-bottom: 20px;">You can access your digital downloads securely from your Royal Dashboard at any time.</p>
                    <a href="{{ url('/my-account') }}" class="btn">Access My Downloads</a>
                </div>

                <p>If you have any questions or require assistance, please do not hesitate to contact our concierge service.</p>
                <p>Sincerely,<br>The Lexoria Diamond Team</p>
            </div>
            
            <div class="footer">
                &copy; {{ date('Y') }} Lexoria Diamond. All rights reserved.<br>
                This email was sent because you recently purchased a digital product from our store.
            </div>
        </div>
    </div>
</body>
</html>
