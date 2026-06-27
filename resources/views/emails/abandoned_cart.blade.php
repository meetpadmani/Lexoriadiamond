<!DOCTYPE html>
<html>
<head>
    <style>
        body { font-family: 'Playfair Display', serif; color: #3d0a0a; background: #fdfbf7; margin: 0; padding: 20px; }
        .container { max-width: 600px; margin: 0 auto; background: #ffffff; border: 1px solid #b58d55; padding: 40px; }
        .header { text-align: center; border-bottom: 2px solid #b58d55; padding-bottom: 20px; margin-bottom: 30px; }
        .logo { font-size: 24px; font-weight: bold; color: #3d0a0a; letter-spacing: 2px; }
        .content { line-height: 1.6; }
        .product-list { margin-top: 30px; }
        .product-item { display: flex; align-items: center; margin-bottom: 20px; border-bottom: 1px solid #eee; padding-bottom: 10px; }
        .product-img { width: 80px; height: 80px; object-fit: cover; border: 1px solid #b58d55; margin-right: 20px; }
        .product-info { flex: 1; }
        .product-name { font-weight: bold; margin: 0; }
        .product-price { color: #b58d55; font-weight: bold; }
        .footer { text-align: center; margin-top: 40px; font-size: 12px; color: #777; }
        .cta-btn { display: inline-block; padding: 12px 30px; background: #3d0a0a; color: #ffffff !important; text-decoration: none; font-weight: bold; border-radius: 4px; margin-top: 20px; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <div class="logo">LEXORIA DIAMONDS</div>
        </div>
        <div class="content">
            <h2>Namaste {{ $user->name }},</h2>
            <p>You left some beautiful pieces in your shopping bag. We wanted to remind you before they are gone!</p>
            
            <div class="product-list">
                @foreach($cartItems as $item)
                    <div class="product-item">
                        <img src="{{ asset($item->product->image) }}" class="product-img">
                        <div class="product-info">
                            <p class="product-name">{{ $item->product->name }}</p>
                            <p class="product-price">${{ number_format($item->product->price) }}</p>
                        </div>
                    </div>
                @endforeach
            </div>

            <center>
                <a href="{{ route('cart.index') }}" class="cta-btn">RETURN TO MY BAG</a>
            </center>

            <p style="margin-top: 30px;">If you have any questions about these pieces, please don't hesitate to reach out to our royal concierge.</p>
        </div>
        <div class="footer">
            &copy; {{ date('Y') }} Lexoria Diamonds. All rights reserved.<br>
            Rajkot, Gujarat, India.
        </div>
    </div>
</body>
</html>
