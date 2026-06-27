@include('frontend.navbar')

<!-- Google Fonts -->
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700&family=Playfair+Display:wght@400;600;700&family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">

<style>
    :root {
        --raj-maroon: #0F1F17; /* Deep luxury green/black */
        --raj-gold: #c5a059;
        --raj-gold-dark: #a38244;
        --raj-sand: #ffffff;
        --raj-sand-light: #f9f9f8;
        --raj-grey: #8a8a8a;
        --raj-border: #e0ded8;
        --font-heading: 'Playfair Display', serif;
        --font-accent: 'Inter', sans-serif;
        --font-body: 'Outfit', sans-serif;
    }

    body {
        font-family: var(--font-body);
        color: var(--raj-maroon);
        background-color: var(--raj-sand-light);
        -webkit-font-smoothing: antialiased;
    }

    .checkout-bg-pattern { display: none; }

    .checkout-container {
        max-width: 1250px;
        margin: 0 auto;
        padding: 60px 30px 100px;
        display: grid;
        grid-template-columns: 1.5fr 1fr;
        gap: 60px;
    }

    .checkout-title {
        font-family: var(--font-heading);
        font-size: 3.2rem;
        color: var(--raj-maroon);
        margin-bottom: 50px;
        font-weight: 500;
        letter-spacing: -0.5px;
    }

    .checkout-section-block {
        background: transparent;
        margin-bottom: 50px;
    }

    .checkout-section-title {
        font-family: var(--font-heading);
        font-size: 1.8rem;
        color: var(--raj-maroon);
        margin-bottom: 30px;
        display: flex;
        align-items: center;
        gap: 15px;
        font-weight: 600;
        border-bottom: 1px solid var(--raj-border);
        padding-bottom: 15px;
    }

    .checkout-section-title span.step-no {
        background: var(--raj-gold);
        color: #fff;
        width: 32px;
        height: 32px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1rem;
        font-weight: 600;
        font-family: var(--font-heading);
        border-radius: 50%;
    }

    .form-group {
        margin-bottom: 25px;
        position: relative;
    }

    .form-group label {
        display: block;
        font-size: 0.75rem;
        color: var(--raj-grey);
        margin-bottom: 10px;
        font-weight: 600;
        font-family: var(--font-accent);
        text-transform: uppercase;
        letter-spacing: 1.5px;
    }

    .form-control {
        width: 100%;
        padding: 16px 20px;
        background: var(--raj-sand);
        border: 1px solid var(--raj-border);
        border-radius: 8px;
        font-family: var(--font-body);
        font-size: 1rem;
        color: var(--raj-maroon);
        outline: none;
        transition: all 0.3s ease;
        box-shadow: 0 2px 10px rgba(0,0,0,0.02);
    }

    .form-control:focus {
        border-color: var(--raj-gold);
        box-shadow: 0 0 0 4px rgba(197, 160, 89, 0.1);
    }

    .form-row {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 25px;
    }

    .payment-options {
        display: flex;
        flex-direction: column;
        gap: 15px;
    }

    .payment-option {
        border: 1px solid var(--raj-border);
        border-radius: 8px;
        padding: 25px;
        display: flex;
        align-items: flex-start;
        gap: 20px;
        cursor: pointer;
        transition: all 0.3s ease;
        background: var(--raj-sand);
        box-shadow: 0 2px 10px rgba(0,0,0,0.02);
    }

    .payment-option:hover {
        border-color: var(--raj-gold);
        background: #fafaf9;
    }

    .payment-option input {
        accent-color: var(--raj-gold);
        transform: scale(1.4);
        margin-top: 5px;
    }

    .payment-option-details {
        flex: 1;
    }

    .payment-option-details h4 {
        margin: 0 0 6px 0;
        font-size: 1.15rem;
        color: var(--raj-maroon);
        font-weight: 600;
        font-family: var(--font-accent);
    }

    .payment-option-details p {
        margin: 0;
        font-size: 0.95rem;
        color: var(--raj-grey);
        line-height: 1.5;
    }

    /* Sidebar summary */
    .order-summary-sidebar {
        background: var(--raj-maroon);
        border-radius: 12px;
        padding: 45px 40px;
        box-shadow: 0 30px 60px rgba(15, 31, 23, 0.2);
        position: sticky;
        top: 40px;
        color: #fff;
    }

    .order-summary-title {
        font-family: var(--font-heading);
        font-size: 2.2rem;
        color: #fff;
        margin-bottom: 35px;
        border-bottom: 1px solid rgba(255,255,255,0.1);
        padding-bottom: 20px;
        font-weight: 400;
    }

    .summary-item {
        display: flex;
        gap: 20px;
        margin-bottom: 25px;
        align-items: center;
    }

    .summary-img img {
        width: 80px;
        height: 80px;
        object-fit: cover;
        border-radius: 8px;
        border: 1px solid rgba(255,255,255,0.2);
    }

    .summary-info {
        flex: 1;
    }

    .summary-info h4 {
        font-size: 1.05rem;
        margin: 0 0 6px 0;
        font-weight: 500;
        line-height: 1.4;
        font-family: var(--font-body);
        color: #fff;
    }

    .summary-info p {
        font-size: 0.85rem;
        color: rgba(255,255,255,0.6);
        margin: 0 0 6px 0;
    }

    .summary-info p:last-child {
        font-weight: 600;
        color: var(--raj-gold);
        font-size: 1.15rem;
        margin: 0;
    }

    .summary-totals {
        border-top: 1px solid rgba(255,255,255,0.1);
        padding-top: 25px;
        margin-top: 25px;
    }

    .summary-row {
        display: flex;
        justify-content: space-between;
        margin-bottom: 18px;
        font-size: 1.05rem;
        font-family: var(--font-body);
        color: rgba(255,255,255,0.8);
    }

    .summary-row.discount {
        color: #4ade80;
    }

    .summary-row.total {
        font-size: 1.8rem;
        font-weight: 600;
        margin-top: 25px;
        border-top: 1px solid rgba(255,255,255,0.1);
        padding-top: 25px;
        font-family: var(--font-heading);
        color: #fff;
    }

    /* Coupon */
    .coupon-form {
        display: flex;
        gap: 12px;
        margin-bottom: 35px;
    }

    .coupon-input {
        flex: 1;
        padding: 15px 20px;
        background: rgba(255,255,255,0.05);
        border: 1px solid rgba(255,255,255,0.15);
        color: #fff;
        outline: none;
        font-family: var(--font-body);
        border-radius: 8px;
        font-size: 1rem;
        transition: all 0.3s;
    }
    
    .coupon-input::placeholder {
        color: rgba(255,255,255,0.4);
    }

    .coupon-input:focus {
        border-color: var(--raj-gold);
        background: rgba(255,255,255,0.08);
    }

    .coupon-btn {
        background: var(--raj-gold);
        color: #fff;
        border: none;
        padding: 0 25px;
        cursor: pointer;
        font-weight: 700;
        font-family: var(--font-accent);
        text-transform: uppercase;
        letter-spacing: 1px;
        font-size: 0.85rem;
        transition: all 0.3s ease;
        border-radius: 8px;
    }

    .coupon-btn:hover {
        background: var(--raj-gold-dark);
        transform: translateY(-2px);
    }

    /* Main Button */
    .btn-place-order {
        width: 100%;
        padding: 22px;
        background: var(--raj-maroon);
        color: var(--raj-gold);
        border: 1px solid var(--raj-gold);
        font-size: 1.2rem;
        font-weight: 700;
        font-family: var(--font-accent);
        text-transform: uppercase;
        letter-spacing: 2.5px;
        cursor: pointer;
        margin-top: 40px;
        transition: all 0.4s ease;
        border-radius: 8px;
    }

    .btn-place-order:hover {
        background: var(--raj-gold);
        color: var(--raj-maroon);
        box-shadow: 0 10px 20px rgba(197, 160, 89, 0.2);
    }

    /* Modals & Alerts */
    .checkout-auth-prompt {
        padding: 20px;
        background: #f0fdf4;
        border-radius: 8px;
        border-left: 4px solid #27ae60;
        margin-top: 20px;
    }

    .auth-prompt-text h3 {
        color: #166534;
        font-size: 1.1rem;
        font-family: var(--font-accent);
        margin-bottom: 5px;
    }

    .auth-prompt-text p {
        color: #166534;
        font-size: 0.95rem;
    }

    @media (max-width: 992px) {
        .checkout-container {
            grid-template-columns: 1fr;
            gap: 40px;
        }
        .order-summary-sidebar {
            position: static;
        }
    }
</style>

<div class="checkout-bg-pattern"></div>

<div class="checkout-container">
    <div class="checkout-content">
        <h1 class="checkout-title">Complete Your Order</h1>

        @if(session('error'))
            <div style="background: #fff5f5; color: #c53030; padding: 20px; border-left: 5px solid #c53030; margin-bottom: 30px; border-radius: 8px; font-weight: 500;">
                <i class="bi bi-exclamation-triangle-fill me-2"></i> {{ session('error') }}
            </div>
        @endif

        @if($errors->any())
            <div style="background: #fff5f5; color: #c53030; padding: 20px; border-left: 5px solid #c53030; margin-bottom: 30px; border-radius: 8px;">
                <ul class="mb-0">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="{{ route('checkout.placeOrder') }}" method="POST" id="checkoutForm">
            @csrf

            <div class="checkout-section-block">
                <h2 class="checkout-section-title"><span class="step-no">1</span> Delivery Details</h2>
                <div class="form-row">
                    <div class="form-group">
                        <label>First Name</label>
                        <input type="text" name="first_name" class="form-control" required placeholder="First Name" value="{{ auth()->user() ? explode(' ', auth()->user()->name)[0] : '' }}">
                    </div>
                    <div class="form-group">
                        <label>Last Name</label>
                        <input type="text" name="last_name" class="form-control" required placeholder="Last Name" value="{{ auth()->user() && count(explode(' ', auth()->user()->name)) > 1 ? explode(' ', auth()->user()->name)[1] : '' }}">
                    </div>
                </div>
                <div class="form-group">
                    <label>Email Address</label>
                    <input type="email" name="email" class="form-control" required placeholder="your@email.com" value="{{ auth()->user() ? auth()->user()->email : '' }}">
                </div>
                <div class="form-group">
                    <label>Mobile Number</label>
                    <input type="tel" name="mobile" class="form-control" required placeholder="+91 9876543210" value="{{ auth()->user() ? (auth()->user()->mobile ?? '') : '' }}">
                </div>
                
                @if($isOnlyDigital)
                    <div class="form-group">
                        <label>Country</label>
                        <select name="country" class="form-control" required>
                            <option value="India" selected>India</option>
                            <option value="United States">United States</option>
                            <option value="United Kingdom">United Kingdom</option>
                            <option value="Australia">Australia</option>
                            <option value="Canada">Canada</option>
                            <option value="Other">Other</option>
                        </select>
                    </div>
                    <div class="checkout-auth-prompt">
                        <div class="auth-prompt-text">
                            <h3><i class="bi bi-cloud-arrow-down me-2"></i> Digital Product Order</h3>
                            <p>No physical shipping is required. Your digital files will be securely sent to your email after purchase.</p>
                        </div>
                    </div>
                @else
                    <div class="form-group">
                        <label>Shipping Address</label>
                        <textarea name="address" class="form-control" rows="3" required placeholder="House No, Street, Landmark"></textarea>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label>City</label>
                            <input type="text" name="city" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Pincode</label>
                            <input type="text" name="pincode" class="form-control" required>
                        </div>
                    </div>
                @endif
                <div class="form-group mt-3">
                    <label>GST Number (Optional)</label>
                    <input type="text" name="gst_number" class="form-control" placeholder="For Corporate Invoicing">
                </div>
            </div>

            <div class="checkout-section-block">
                <h2 class="checkout-section-title"><span class="step-no">2</span> Payment Method</h2>
                <div class="payment-options">
                    <label class="payment-option">
                        <input type="radio" name="payment_method" value="razorpay" checked>
                        <div class="payment-option-details">
                            <h4>Pay Online (Credit Card / UPI / NetBanking)</h4>
                            <p>Fast and secure payment through our trusted gateway.</p>
                        </div>
                    </label>
                </div>
                <button type="submit" class="btn-place-order" >Place Order Securely</button>
            </div>
        </form>
    </div>

    <!-- Order Sidebar -->
    <div class="order-sidebar">
        <div class="order-summary-sidebar">
            <h2 class="order-summary-title">Order Summary</h2>

            @if(count($cartItems) > 0)
                @foreach($cartItems as $item)
                    <div class="summary-item">
                        <div class="summary-img">
                            <img src="{{ str_starts_with($item['image'], 'http') ? $item['image'] : asset($item['image']) }}" alt="{{ $item['name'] }}">
                        </div>
                        <div class="summary-info">
                            <h4>{{ $item['name'] }}</h4>
                            @php
                                $isDigitalSummary = false;
                                $prod = \App\Models\Product::find($item['id'] ?? null);
                                if ($prod && $prod->is_digital) $isDigitalSummary = true;
                            @endphp
                            @if(!$isDigitalSummary)
                                <p>Qty: {{ $item['quantity'] }}</p>
                            @else
                                <p style="font-size: 0.8rem; text-transform: uppercase; letter-spacing: 1px;">Digital</p>
                            @endif
                            <p>${{ number_format($item['price'] * $item['quantity']) }}</p>
                        </div>
                    </div>
                @endforeach

                <div class="summary-totals">
                    <div class="summary-row">
                        <span>Subtotal</span>
                        <span>${{ number_format($total) }}</span>
                    </div>

                    @if(isset($discount) && $discount > 0)
                        <div class="summary-row" style="color: #27ae60;">
                            <span>Royal Discount ({{ session('coupon')['code'] }})</span>
                            <span>- ${{ number_format($discount) }}</span>
                        </div>
                    @endif

                    <div class="summary-row">
                        <span>Insured Delivery</span>
                        <span>Free</span>
                    </div>

                    {{-- Coupon Input --}}
                    <div class="coupon-application-section mt-4 mb-4">
                        <form action="{{ route('checkout.applyCoupon') }}" method="POST">
                            @csrf
                            <label class="extra-small text-uppercase fw-bold mb-2 d-block" style="letter-spacing: 1px; color: rgba(255,255,255,0.6);">Apply Royal Mandate (Coupon)</label>
                            <div class="coupon-form">
                                <input type="text" name="code" class="coupon-input" placeholder="Enter Code"  value="{{ session('coupon')['code'] ?? '' }}">
                                <button type="submit" class="coupon-btn">APPLY</button>
                            </div>
                        </form>
                    </div>

                    <div class="summary-row total">
                        <span>Total Payable</span>
                        <span>${{ number_format($total - ($discount ?? 0)) }}</span>
                    </div>
                </div>
            @else
                <p style="color: rgba(255,255,255,0.6);">Your cart is empty.</p>
                <a href="{{ route('collections') }}" style="color: var(--raj-gold); text-decoration: none; display: inline-block; margin-top: 10px; font-family: var(--font-accent); letter-spacing: 2px; text-transform: uppercase; font-size: 0.8rem;">Continue Shopping →</a>
            @endif
        </div>
    </div>
</div>






