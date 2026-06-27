<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Processing Payment - Lexoria Diamond</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700&family=Inter:wght@400;600&display=swap" rel="stylesheet">
    <style>
        body {
            background: #f4ece2;
            font-family: 'Inter', sans-serif;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
            color: #0F1F17;
            text-align: center;
        }
        .loader-box {
            background: white;
            padding: 50px;
            box-shadow: 0 20px 40px rgba(0,0,0,0.1);
            border: 1px solid #333333;
        }
        h1 {
            font-family: 'Inter', serif;
            font-size: 1.5rem;
            margin-bottom: 10px;
        }
        .spinner {
            width: 50px;
            height: 50px;
            border: 5px solid #f3f3f3;
            border-top: 5px solid #333333;
            border-radius: 50%;
            animation: spin 1s linear infinite;
            margin: 20px auto;
        }
        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
    </style>
</head>
<body>

    <div class="loader-box">
        <span style="font-size: 2.5rem; color: #333333; display: block; margin-bottom: 20px;">❖</span>
        <div class="spinner"></div>
        <h1>Royal Acquisition</h1>
        <p>Connecting to our secure payment vault...</p>
        <div style="margin-top: 30px; font-size: 0.7rem; letter-spacing: 2px; color: #888888; text-transform: uppercase;">
            Encrypted & Secured by Razorpay
        </div>
    </div>

    <form action="{{ route('razorpay.callback') }}" method="POST" name="razorpayForm" id="razorpayForm" style="display: none;">
        @csrf
        <input type="hidden" name="razorpay_payment_id" id="razorpay_payment_id">
        <input type="hidden" name="razorpay_order_id" value="{{ $razorpay_order_id }}">
        <input type="hidden" name="razorpay_signature" id="razorpay_signature">
        <input type="hidden" name="order_number" value="{{ $order->order_number }}">
    </form>

    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
    <script>
        var options = {
            "key": "{{ $razorpay_key }}",
            "amount": "{{ $amount }}",
            "currency": "USD",
            "name": "Lexoria Diamond",
            "description": "Payment for Order {{ $order->order_number }}",
            "image": "https://bhaumikdiamond.com/assets/images/logo.png", // Fallback to a valid URL if local doesn't exist
            "order_id": "{{ $razorpay_order_id }}",
            "handler": function (response){
                document.getElementById('razorpay_payment_id').value = response.razorpay_payment_id;
                document.getElementById('razorpay_signature').value = response.razorpay_signature;
                document.getElementById('razorpayForm').submit();
            },
            "prefill": {
                "name": "{{ $order->first_name }} {{ $order->last_name }}",
                "email": "{{ $order->email }}",
                "contact": "{{ $order->mobile }}"
            },
            "theme": {
                "color": "#0F1F17"
            },
            "modal": {
                "ondismiss": function(){
                    window.location.href = "{{ route('checkout.index') }}?payment=cancelled";
                }
            }
        };
        var rzp1 = new Razorpay(options);
        
        // Auto open the popup after a small delay
        window.onload = function() {
            setTimeout(function() {
                rzp1.open();
            }, 800);
        };
    </script>
</body>
</html>

