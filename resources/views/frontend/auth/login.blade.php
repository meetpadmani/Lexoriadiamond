@include('frontend.navbar')

<link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&family=Playfair+Display:ital,wght@0,400;0,500;0,600;0,700;1,400&display=swap" rel="stylesheet">

<style>
    body {
        background: #fdfaf7;
        font-family: 'Outfit', sans-serif;
        margin: 0;
    }

    /* ===== ANIMATED PARTICLES BACKGROUND ===== */
    .auth-page {
        min-height: calc(100vh - 80px);
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 40px 20px;
        position: relative;
        overflow: hidden;
    }

    /* Floating golden particles */
    .particle {
        position: absolute;
        border-radius: 50%;
        background: radial-gradient(circle, rgba(212, 175, 55, 0.3), transparent);
        pointer-events: none;
        animation: floatParticle linear infinite;
    }
    .particle:nth-child(1) { width: 300px; height: 300px; top: -100px; left: -50px; animation-duration: 20s; }
    .particle:nth-child(2) { width: 200px; height: 200px; bottom: -50px; right: -30px; animation-duration: 25s; animation-delay: -5s; }
    .particle:nth-child(3) { width: 150px; height: 150px; top: 30%; right: 10%; animation-duration: 18s; animation-delay: -8s; }
    .particle:nth-child(4) { width: 100px; height: 100px; bottom: 20%; left: 15%; animation-duration: 22s; animation-delay: -3s; }

    @keyframes floatParticle {
        0%, 100% { transform: translateY(0) translateX(0) scale(1); opacity: 0.4; }
        25% { transform: translateY(-40px) translateX(20px) scale(1.1); opacity: 0.6; }
        50% { transform: translateY(-20px) translateX(-30px) scale(0.9); opacity: 0.3; }
        75% { transform: translateY(30px) translateX(10px) scale(1.05); opacity: 0.5; }
    }

    /* ===== MAIN CARD WITH GRADIENT BORDER ===== */
    .auth-card {
        position: relative;
        background: #ffffff;
        border-radius: 24px;
        display: flex;
        width: 100%;
        max-width: 1000px;
        min-height: 620px;
        overflow: hidden;
        z-index: 2;
        box-shadow: 0 25px 60px rgba(0, 0, 0, 0.08), 0 0 0 1px rgba(212, 175, 55, 0.1);
        
        /* Staggered entrance animation */
        opacity: 0;
        transform: translateY(30px) scale(0.97);
        animation: cardReveal 0.8s cubic-bezier(0.16, 1, 0.3, 1) 0.2s forwards;
    }

    @keyframes cardReveal {
        to { opacity: 1; transform: translateY(0) scale(1); }
    }

    /* Animated gradient border glow */
    .auth-card::before {
        content: '';
        position: absolute;
        top: -2px; left: -2px; right: -2px; bottom: -2px;
        border-radius: 26px;
        background: linear-gradient(135deg, rgba(212, 175, 55, 0.4), transparent, rgba(212, 175, 55, 0.2), transparent);
        background-size: 300% 300%;
        animation: borderGlow 6s ease-in-out infinite;
        z-index: -1;
    }

    @keyframes borderGlow {
        0%, 100% { background-position: 0% 50%; }
        50% { background-position: 100% 50%; }
    }

    /* ===== LEFT SIDE: IMAGE WITH PARALLAX TEXT ===== */
    .auth-image-box {
        flex: 1;
        background-color: #f5eedc;
        background-image: url('https://images.unsplash.com/photo-1599643478518-a784e5dc4c8f?q=80&w=1000');
        background-size: cover;
        background-position: center;
        position: relative;
        display: none;
    }

    @media (min-width: 992px) {
        .auth-image-box { display: flex; align-items: flex-end; }
    }

    .auth-image-box::after {
        content: '';
        position: absolute;
        inset: 0;
        background: linear-gradient(to top, rgba(0,0,0,0.7) 0%, rgba(0,0,0,0.1) 50%, transparent 100%);
    }

    .auth-image-text {
        position: relative;
        z-index: 2;
        padding: 50px 40px;
        width: 100%;
    }

    /* Letter-by-letter reveal for hero text */
    .auth-image-text h2 {
        font-family: 'Playfair Display', serif;
        font-size: 2.5rem;
        color: #ffffff;
        margin: 0 0 12px 0;
        font-style: italic;
        opacity: 0;
        animation: slideReveal 0.8s cubic-bezier(0.16, 1, 0.3, 1) 0.6s forwards;
    }

    .auth-image-text p {
        font-size: 0.9rem;
        color: rgba(255, 255, 255, 0.8);
        letter-spacing: 2px;
        text-transform: uppercase;
        opacity: 0;
        animation: slideReveal 0.8s cubic-bezier(0.16, 1, 0.3, 1) 0.9s forwards;
    }

    /* Trust badges with staggered animation */
    .trust-badges {
        display: flex;
        gap: 20px;
        margin-top: 25px;
    }
    .trust-badge {
        display: flex;
        align-items: center;
        gap: 8px;
        color: rgba(255, 255, 255, 0.7);
        font-size: 0.75rem;
        letter-spacing: 1px;
        text-transform: uppercase;
        opacity: 0;
        animation: slideReveal 0.8s cubic-bezier(0.16, 1, 0.3, 1) forwards;
    }
    .trust-badge:nth-child(1) { animation-delay: 1.1s; }
    .trust-badge:nth-child(2) { animation-delay: 1.3s; }
    .trust-badge:nth-child(3) { animation-delay: 1.5s; }
    .trust-badge i { color: rgba(212, 175, 55, 0.8); font-size: 1rem; }

    @keyframes slideReveal {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }

    /* ===== RIGHT SIDE: FORM ===== */
    .auth-form-box {
        flex: 1;
        padding: 55px;
        display: flex;
        flex-direction: column;
        justify-content: center;
    }

    /* Staggered form element animations */
    .auth-header {
        margin-bottom: 35px;
        opacity: 0;
        animation: slideReveal 0.7s cubic-bezier(0.16, 1, 0.3, 1) 0.4s forwards;
    }

    .auth-header h1 {
        font-family: 'Playfair Display', serif;
        font-size: 2.2rem;
        color: #111111;
        margin: 0 0 8px 0;
        font-weight: 500;
    }

    .auth-header p {
        color: #999999;
        font-size: 0.9rem;
        font-weight: 300;
    }

    /* Animated pill tabs */
    .auth-tabs {
        display: flex;
        background: #f8f5f1;
        border-radius: 50px;
        padding: 4px;
        margin-bottom: 30px;
        border: 1px solid rgba(212, 175, 55, 0.1);
        position: relative;
        opacity: 0;
        animation: slideReveal 0.7s cubic-bezier(0.16, 1, 0.3, 1) 0.55s forwards;
    }

    .auth-tab {
        flex: 1;
        text-align: center;
        padding: 11px 20px;
        cursor: pointer;
        font-weight: 500;
        font-size: 0.85rem;
        color: #999999;
        border-radius: 50px;
        transition: all 0.4s cubic-bezier(0.16, 1, 0.3, 1);
        position: relative;
        z-index: 1;
    }

    .auth-tab.active {
        background: #ffffff;
        color: #111111;
        box-shadow: 0 2px 15px rgba(0, 0, 0, 0.06);
    }

    .auth-tab:hover:not(.active) {
        color: #666666;
    }

    /* ===== ANIMATED INPUTS ===== */
    .premium-field {
        margin-bottom: 22px;
        position: relative;
        opacity: 0;
        animation: slideReveal 0.7s cubic-bezier(0.16, 1, 0.3, 1) forwards;
    }
    .premium-field:nth-child(1) { animation-delay: 0.65s; }
    .premium-field:nth-child(2) { animation-delay: 0.8s; }

    .premium-label {
        display: block;
        font-size: 0.78rem;
        font-weight: 500;
        color: #555555;
        margin-bottom: 8px;
        text-transform: uppercase;
        letter-spacing: 1px;
        transition: color 0.3s;
    }

    .input-wrapper {
        position: relative;
    }

    .input-wrapper i {
        position: absolute;
        left: 16px;
        top: 50%;
        transform: translateY(-50%);
        color: #cccccc;
        font-size: 1rem;
        transition: color 0.3s;
    }

    .premium-input {
        width: 100%;
        background: #f8f5f1;
        border: 1.5px solid transparent;
        border-radius: 12px;
        padding: 15px 16px 15px 45px;
        font-size: 0.95rem;
        color: #111111;
        font-family: 'Outfit', sans-serif;
        transition: all 0.4s cubic-bezier(0.16, 1, 0.3, 1);
    }

    .premium-input::placeholder {
        color: #bbbbbb;
        font-weight: 300;
    }

    /* Beautiful focus animation */
    .premium-input:focus {
        background: #ffffff;
        border-color: rgba(212, 175, 55, 0.5);
        outline: none;
        box-shadow: 0 0 0 4px rgba(212, 175, 55, 0.08), 0 4px 15px rgba(0, 0, 0, 0.04);
        transform: translateY(-1px);
    }

    .premium-input:focus + .input-glow,
    .premium-input:focus ~ i {
        color: #b58d55;
    }

    /* ===== ACTION LINKS ===== */
    .action-links {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 25px;
        font-size: 0.85rem;
        opacity: 0;
        animation: slideReveal 0.7s cubic-bezier(0.16, 1, 0.3, 1) 0.9s forwards;
    }

    .checkbox-wrap {
        display: flex;
        align-items: center;
        gap: 8px;
        color: #888888;
        cursor: pointer;
        transition: color 0.3s;
    }
    .checkbox-wrap:hover { color: #111111; }
    .checkbox-wrap input { accent-color: #b58d55; width: 16px; height: 16px; }

    .forgot-link {
        color: #b58d55;
        font-weight: 500;
        text-decoration: none;
        position: relative;
        transition: color 0.3s;
    }
    .forgot-link::after {
        content: '';
        position: absolute;
        bottom: -2px;
        left: 0;
        width: 0;
        height: 1px;
        background: #b58d55;
        transition: width 0.3s;
    }
    .forgot-link:hover::after { width: 100%; }
    .forgot-link:hover { color: #111111; }

    /* ===== ANIMATED SUBMIT BUTTON ===== */
    .btn-submit-wrap {
        opacity: 0;
        animation: slideReveal 0.7s cubic-bezier(0.16, 1, 0.3, 1) 1s forwards;
    }

    .btn-rajwadi {
        width: 100%;
        background: linear-gradient(135deg, #111111 0%, #333333 100%);
        color: #ffffff;
        border: none;
        padding: 16px;
        border-radius: 12px;
        font-weight: 500;
        font-size: 0.95rem;
        letter-spacing: 1px;
        cursor: pointer;
        transition: all 0.4s cubic-bezier(0.16, 1, 0.3, 1);
        position: relative;
        overflow: hidden;
        font-family: 'Outfit', sans-serif;
    }

    .btn-rajwadi::before {
        content: '';
        position: absolute;
        top: 0; left: -100%;
        width: 100%; height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255,255,255,0.1), transparent);
        transition: left 0.6s;
    }

    .btn-rajwadi:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
        background: linear-gradient(135deg, #b58d55 0%, #8a6d3b 100%);
    }

    .btn-rajwadi:hover::before {
        left: 100%;
    }

    .btn-rajwadi:active {
        transform: translateY(0);
    }

    /* ===== OTP BUTTON VARIANT ===== */
    .btn-otp {
        width: 100%;
        background: transparent;
        color: #111111;
        border: 1.5px solid #e0d5c9;
        padding: 16px;
        border-radius: 12px;
        font-weight: 500;
        font-size: 0.95rem;
        letter-spacing: 1px;
        cursor: pointer;
        transition: all 0.4s cubic-bezier(0.16, 1, 0.3, 1);
        font-family: 'Outfit', sans-serif;
    }
    .btn-otp:hover {
        border-color: #b58d55;
        background: rgba(181, 141, 85, 0.05);
        transform: translateY(-2px);
    }

    /* ===== FOOTER ===== */
    .auth-footer {
        margin-top: 35px;
        text-align: center;
        font-size: 0.9rem;
        color: #999999;
        opacity: 0;
        animation: slideReveal 0.7s cubic-bezier(0.16, 1, 0.3, 1) 1.1s forwards;
    }
    .auth-footer a {
        color: #111111;
        font-weight: 600;
        text-decoration: none;
        position: relative;
        transition: color 0.3s;
    }
    .auth-footer a::after {
        content: '';
        position: absolute;
        bottom: -2px;
        left: 0;
        width: 100%;
        height: 1px;
        background: #b58d55;
        transform: scaleX(0);
        transition: transform 0.3s;
    }
    .auth-footer a:hover { color: #b58d55; }
    .auth-footer a:hover::after { transform: scaleX(1); }

    /* ===== DIVIDER ===== */
    .divider-text {
        display: flex;
        align-items: center;
        gap: 15px;
        margin: 25px 0;
        color: #cccccc;
        font-size: 0.8rem;
        text-transform: uppercase;
        letter-spacing: 2px;
        opacity: 0;
        animation: slideReveal 0.7s cubic-bezier(0.16, 1, 0.3, 1) 1.05s forwards;
    }
    .divider-text::before, .divider-text::after {
        content: '';
        flex: 1;
        height: 1px;
        background: linear-gradient(90deg, transparent, #e0d5c9, transparent);
    }

    /* ===== FORM SECTIONS ===== */
    .form-section {
        display: none;
    }
    .form-section.active {
        display: block;
        animation: formSwitch 0.5s cubic-bezier(0.16, 1, 0.3, 1);
    }
    @keyframes formSwitch {
        from { opacity: 0; transform: translateX(15px); }
        to { opacity: 1; transform: translateX(0); }
    }

    /* ===== ALERTS ===== */
    .alert-custom {
        padding: 14px 18px;
        border-radius: 12px;
        margin-bottom: 20px;
        font-size: 0.85rem;
        animation: slideReveal 0.5s ease forwards;
    }
    .alert-success-custom {
        background: #f0fdf4;
        color: #166534;
        border: 1px solid #dcfce7;
    }
    .alert-danger-custom {
        background: #fef2f2;
        color: #991b1b;
        border: 1px solid #fee2e2;
    }

    /* ===== MOBILE ===== */
    @media (max-width: 768px) {
        .auth-page { padding: 20px 15px; }
        .auth-card { border-radius: 20px; min-height: auto; }
        .auth-form-box { padding: 35px 25px; }
        .auth-header h1 { font-size: 1.8rem; }
        .auth-tabs { margin-bottom: 25px; }
        .action-links { flex-direction: column; align-items: flex-start; gap: 15px; }
        .trust-badges { flex-direction: column; gap: 10px; }
    }
</style>

<section class="auth-page">
    <!-- Floating Particles -->
    <div class="particle"></div>
    <div class="particle"></div>
    <div class="particle"></div>
    <div class="particle"></div>

    <div class="auth-card">
        
        <!-- Left Side: Image -->
        <div class="auth-image-box">
            <div class="auth-image-text">
                <h2>Exquisite Craftsmanship</h2>
                <p>Your journey to timeless elegance begins here</p>
                <div class="trust-badges">
                    <div class="trust-badge"><i class="bi bi-shield-check"></i> Secure</div>
                    <div class="trust-badge"><i class="bi bi-gem"></i> Certified</div>
                    <div class="trust-badge"><i class="bi bi-truck"></i> Free Shipping</div>
                </div>
            </div>
        </div>

        <!-- Right Side: Form -->
        <div class="auth-form-box">
            
            <div class="auth-header">
                <h1>Welcome Back</h1>
                <p>Sign in to your Lexoria Diamond account</p>
            </div>

            @if (session('success'))
                <div class="alert-custom alert-success-custom">
                    {{ session('success') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="alert-custom alert-danger-custom">
                    @foreach ($errors->all() as $error)
                        <div>• {{ $error }}</div>
                    @endforeach
                </div>
            @endif

            <!-- Tabs -->
            <div class="auth-tabs">
                <div class="auth-tab active" onclick="switchTab('password')">Password</div>
                <div class="auth-tab" onclick="switchTab('otp')">Send Code</div>
            </div>

            <!-- Password Login Form -->
            <form action="{{ route('login') }}" method="POST" id="form-password" class="form-section active">
                @csrf
                <div class="premium-field">
                    <label class="premium-label">Email Address</label>
                    <div class="input-wrapper">
                        <i class="bi bi-envelope"></i>
                        <input type="email" name="email" class="premium-input" placeholder="name@example.com" required value="{{ old('email') }}">
                    </div>
                </div>

                <div class="premium-field">
                    <label class="premium-label">Password</label>
                    <div class="input-wrapper">
                        <i class="bi bi-lock"></i>
                        <input type="password" name="password" class="premium-input" placeholder="Enter your password" required>
                    </div>
                </div>

                <div class="action-links">
                    <label class="checkbox-wrap">
                        <input type="checkbox" name="remember"> Remember me
                    </label>
                    <a href="{{ route('password.request') }}" class="forgot-link">Forgot password?</a>
                </div>

                <div class="btn-submit-wrap">
                    <button type="submit" class="btn-rajwadi">Sign In Securely</button>
                </div>
            </form>

            <!-- OTP Login Form -->
            <form action="{{ route('login.otp') }}" method="POST" id="form-otp" class="form-section">
                @csrf
                <div class="premium-field" style="animation-delay: 0.3s;">
                    <label class="premium-label">Email or WhatsApp Number</label>
                    <div class="input-wrapper">
                        <i class="bi bi-person"></i>
                        <input type="text" name="login_id" class="premium-input" placeholder="name@example.com or phone number" required value="{{ old('login_id') }}">
                    </div>
                    <p style="margin-top: 12px; font-size: 0.8rem; color: #999; line-height: 1.6;">
                        We'll send a 6-digit access code to your email or WhatsApp. No password needed.
                    </p>
                </div>

                <div class="btn-submit-wrap" style="animation-delay: 0.5s;">
                    <button type="submit" class="btn-otp">Send Access Code</button>
                </div>
            </form>

            <div class="divider-text">or</div>

            <div class="auth-footer">
                New to Lexoria? <a href="{{ route('register') }}">Create an account</a>
            </div>

        </div>
    </div>
</section>

<script>
    function switchTab(tab) {
        // Toggle Active Tab Styling
        document.querySelectorAll('.auth-tab').forEach(t => t.classList.remove('active'));
        event.target.classList.add('active');

        // Toggle Form Visibility
        document.querySelectorAll('.form-section').forEach(f => f.classList.remove('active'));
        document.getElementById('form-' + tab).classList.add('active');

        // Toggle Required Attributes for Form Validation
        if (tab === 'password') {
            document.querySelector('#form-otp input[name="login_id"]').removeAttribute('required');
            document.querySelector('#form-password input[name="email"]').setAttribute('required', 'required');
            document.querySelector('#form-password input[name="password"]').setAttribute('required', 'required');
        } else {
            document.querySelector('#form-password input[name="email"]').removeAttribute('required');
            document.querySelector('#form-password input[name="password"]').removeAttribute('required');
            document.querySelector('#form-otp input[name="login_id"]').setAttribute('required', 'required');
        }
    }

    // Add focus animation to input icons
    document.querySelectorAll('.premium-input').forEach(input => {
        input.addEventListener('focus', function() {
            this.closest('.input-wrapper').querySelector('i').style.color = '#b58d55';
        });
        input.addEventListener('blur', function() {
            this.closest('.input-wrapper').querySelector('i').style.color = '#cccccc';
        });
    });
</script>

@include('frontend.footer')
