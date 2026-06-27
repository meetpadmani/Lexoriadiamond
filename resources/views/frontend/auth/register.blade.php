@include('frontend.navbar')

<style>
    /* Elegant Box Theme */
    body {
        background-color: #fdfaf7; /* Soft pearl/cream background */
    }

    .auth-page {
        min-height: calc(100vh - 80px);
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 40px 20px;
    }

    .auth-card {
        background: #ffffff;
        border-radius: 16px;
        box-shadow: 0 15px 40px rgba(0, 0, 0, 0.06);
        display: flex;
        width: 100%;
        max-width: 1000px; /* Slightly wider for the registration form */
        min-height: 650px;
        overflow: hidden;
        animation: scaleUp 0.5s ease-out;
    }

    @keyframes scaleUp {
        from { opacity: 0; transform: scale(0.95); }
        to { opacity: 1; transform: scale(1); }
    }

    /* Left Side: Image Box */
    .auth-image-box {
        flex: 1;
        background-color: #f5eedc;
        background-image: url('https://images.unsplash.com/photo-1573408301185-9146fe634ad0?q=80&w=1000');
        background-size: cover;
        background-position: center;
        position: relative;
        display: none;
    }

    @media (min-width: 992px) {
        .auth-image-box {
            display: block;
        }
    }

    .auth-image-box::after {
        content: '';
        position: absolute;
        top: 0; left: 0; right: 0; bottom: 0;
        background: linear-gradient(to bottom, rgba(0,0,0,0.1), rgba(0,0,0,0.4));
    }

    .auth-image-text {
        position: absolute;
        bottom: 40px;
        left: 40px;
        right: 40px;
        color: #ffffff;
        z-index: 2;
    }

    .auth-image-text h2 {
        font-family: 'Playfair Display', serif;
        font-size: 2.2rem;
        margin-bottom: 10px;
        text-shadow: 0 2px 4px rgba(0,0,0,0.3);
    }

    .auth-image-text p {
        font-size: 0.95rem;
        opacity: 0.9;
        letter-spacing: 1px;
    }

    /* Right Side: Form */
    .auth-form-box {
        flex: 1;
        padding: 50px;
        display: flex;
        flex-direction: column;
        justify-content: center;
        overflow-y: auto;
    }

    .auth-header {
        margin-bottom: 35px;
    }

    .auth-header h1 {
        font-family: 'Playfair Display', serif;
        font-size: 2rem;
        color: #111111;
        margin-bottom: 8px;
    }

    .auth-header p {
        color: #888888;
        font-size: 0.9rem;
    }

    /* Inputs */
    .premium-field {
        margin-bottom: 18px;
    }

    .premium-label {
        display: block;
        font-size: 0.8rem;
        font-weight: 600;
        color: #444444;
        margin-bottom: 6px;
    }

    .premium-input {
        width: 100%;
        background: #fdfaf7;
        border: 1px solid #eaeaea;
        border-radius: 8px;
        padding: 12px 16px;
        font-size: 0.95rem;
        color: #111111;
        transition: all 0.2s;
    }

    .premium-input::placeholder {
        color: #bbbbbb;
    }

    .premium-input:focus {
        background: #ffffff;
        border-color: #d4af37;
        outline: none;
        box-shadow: 0 0 0 3px rgba(212, 175, 55, 0.1);
    }

    /* Button */
    .btn-rajwadi {
        width: 100%;
        background-color: #111111;
        color: #ffffff;
        border: none;
        padding: 16px;
        border-radius: 8px;
        font-weight: 600;
        font-size: 0.95rem;
        letter-spacing: 1px;
        cursor: pointer;
        transition: all 0.3s;
        margin-top: 10px;
    }

    .btn-rajwadi:hover {
        background-color: #333333;
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    }

    .auth-footer {
        margin-top: 30px;
        text-align: center;
        font-size: 0.9rem;
        color: #888888;
    }

    .auth-footer a {
        color: #111111;
        font-weight: 600;
        text-decoration: underline;
    }

    .alert-custom {
        padding: 14px;
        border-radius: 8px;
        margin-bottom: 20px;
        font-size: 0.85rem;
    }
    .alert-danger-custom {
        background: #fef2f2;
        color: #991b1b;
        border: 1px solid #fee2e2;
    }

    /* Grid for password fields */
    .password-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 15px;
    }

    /* Mobile Responsiveness */
    @media (max-width: 768px) {
        .auth-page {
            padding: 20px 15px;
            align-items: flex-start;
        }
        .auth-card {
            min-height: auto;
            border-radius: 12px;
        }
        .auth-form-box {
            padding: 35px 25px;
        }
        .auth-header h1 {
            font-size: 1.6rem;
        }
        .auth-header p {
            font-size: 0.85rem;
        }
        .premium-input {
            padding: 12px 14px;
        }
        .btn-rajwadi {
            padding: 14px;
            font-size: 0.9rem;
        }
        .password-grid {
            grid-template-columns: 1fr;
            gap: 0;
        }
    }
</style>

<section class="auth-page">
    <div class="auth-card">
        
        <!-- Left Side: Image -->
        <div class="auth-image-box">
            <div class="auth-image-text">
                <h2>The Lexoria Legacy</h2>
                <p>Join our exclusive circle of patrons and experience luxury like never before.</p>
            </div>
        </div>

        <!-- Right Side: Form -->
        <div class="auth-form-box">
            
            <div class="auth-header">
                <h1>Create Account</h1>
                <p>Register to unlock a world of elegance</p>
            </div>

            @if ($errors->any())
                <div class="alert-custom alert-danger-custom">
                    @foreach ($errors->all() as $error)
                        <div>• {{ $error }}</div>
                    @endforeach
                </div>
            @endif

            <form action="{{ route('register') }}" method="POST">
                @csrf
                <div class="premium-field">
                    <label class="premium-label">Full Name</label>
                    <input type="text" name="name" class="premium-input" placeholder="Enter your full name" required value="{{ old('name') }}">
                </div>

                <div class="premium-field">
                    <label class="premium-label">WhatsApp Number</label>
                    <input type="text" name="phone" class="premium-input" placeholder="e.g. +1234567890" required value="{{ old('phone') }}">
                </div>

                <div class="premium-field">
                    <label class="premium-label">Email Address</label>
                    <input type="email" name="email" class="premium-input" placeholder="name@example.com" required value="{{ old('email') }}">
                    <p style="margin-top: 6px; font-size: 0.75rem; color: #888888; line-height: 1.4;">
                        We will verify your account by sending a secure 6-digit access code to both your Email and WhatsApp.
                    </p>
                </div>

                <div class="password-grid">
                    <div class="premium-field">
                        <label class="premium-label">Password</label>
                        <input type="password" name="password" class="premium-input" placeholder="Create password" required>
                    </div>
                    <div class="premium-field">
                        <label class="premium-label">Confirm Password</label>
                        <input type="password" name="password_confirmation" class="premium-input" placeholder="Repeat password" required>
                    </div>
                </div>

                <p style="color: #888888; font-size: 0.75rem; line-height: 1.5; margin-bottom: 20px; text-align: center;">
                    By joining, you agree to our <a href="{{ route('terms-conditions') }}" style="color: #111111; font-weight: 600;">Terms</a> and <a href="{{ route('privacy-policy') }}" style="color: #111111; font-weight: 600;">Privacy Policy</a>.
                </p>

                <button type="submit" class="btn-rajwadi">Create Account & Verify</button>
            </form>

            <div class="auth-footer">
                Already have an account? <a href="{{ route('login') }}">Sign In</a>
            </div>

        </div>
    </div>
</section>

@include('frontend.footer')
