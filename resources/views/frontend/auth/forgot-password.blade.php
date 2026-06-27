@include('frontend.navbar')

<style>
    .auth-page {
        height: calc(100vh - 100px);
        display: flex;
        background: #ffffff;
        overflow: hidden;
    }

    .auth-image-side {
        flex: 1.2;
        background: #000000;
        position: relative;
        display: flex;
        align-items: center;
        justify-content: center;
        background-image: 
            linear-gradient(rgba(90, 25, 25, 0.8), rgba(90, 25, 25, 0.8)),
            url("https://images.unsplash.com/photo-1599643478518-a784e5dc4c8f?q=80&w=1000");
        background-size: cover;
        background-position: center;
    }

    .auth-image-side::after {
        content: '';
        position: absolute;
        inset: 40px;
        border: 2px solid rgba(0, 0, 0, 0.4);
        pointer-events: none;
    }

    .image-content {
        text-align: center;
        color: #fff;
        z-index: 2;
        padding: 40px;
    }

    .image-content h2 {
        font-family: 'Inter', serif;
        font-size: 3rem;
        margin-bottom: 20px;
        color: #333333;
    }

    .image-content p {
        font-size: 1.1rem;
        letter-spacing: 2px;
        text-transform: uppercase;
        opacity: 0.8;
    }

    .auth-form-side {
        flex: 1;
        background: #fff;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 60px;
        position: relative;
    }

    .form-container {
        width: 100%;
        max-width: 420px;
        animation: fadeInRight 0.8s ease-out;
    }

    @keyframes fadeInRight {
        from { opacity: 0; transform: translateX(30px); }
        to { opacity: 1; transform: translateX(0); }
    }

    .auth-header {
        margin-bottom: 30px;
    }

    .auth-header h1 {
        font-family: 'Inter', serif;
        font-size: 2.2rem;
        color: #000000;
        margin-bottom: 8px;
    }

    .auth-header p {
        color: #888888;
        font-size: 0.9rem;
        line-height: 1.5;
    }

    .premium-field {
        margin-bottom: 20px;
    }

    .premium-label {
        display: block;
        font-size: 0.75rem;
        font-weight: 700;
        text-transform: uppercase;
        color: #8a735a;
        margin-bottom: 8px;
    }

    .premium-input {
        width: 100%;
        background: #fdfaf7;
        border: 1px solid #f2e6d9;
        border-radius: 8px;
        padding: 14px 18px;
        font-size: 0.95rem;
        transition: all 0.3s;
    }

    .premium-input:focus {
        border-color: #333333;
        background: #fff;
        outline: none;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
    }

    .btn-rajwadi {
        width: 100%;
        background: #000000;
        color: #fff;
        border: none;
        padding: 16px;
        border-radius: 8px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 2px;
        cursor: pointer;
        transition: 0.3s;
        margin-top: 10px;
    }

    .btn-rajwadi:hover {
        background: #333333;
        transform: translateY(-2px);
    }

    .auth-footer {
        margin-top: 30px;
        text-align: center;
        font-size: 0.9rem;
        color: #888888;
    }

    .auth-footer a {
        color: #333333;
        font-weight: 700;
        text-decoration: none;
    }

    @media (max-width: 991px) {
        .auth-image-side { display: none; }
        .auth-page { height: auto; padding: 60px 20px; }
    }
</style>

<section class="auth-page">
    <div class="auth-image-side">
        <div class="image-content">
            <h2>Lexoria Diamond</h2>
            <p>Crafting Legacies Since 1995</p>
        </div>
    </div>

    <div class="auth-form-side">
        <div class="form-container">
            <div class="auth-header">
                <h1>Forgot Password</h1>
                <p>Enter your email address and we'll send you a link to reset your password.</p>
            </div>

            @if (session('success'))
                <div style="background: #f0fdf4; color: #166534; padding: 15px; border-radius: 8px; margin-bottom: 20px; font-size: 0.85rem;">
                    {{ session('success') }}
                </div>
            @endif

            @if ($errors->any())
                <div style="background: #fff5f5; color: #c53030; padding: 15px; border-radius: 8px; margin-bottom: 20px; font-size: 0.85rem;">
                    @foreach ($errors->all() as $error)
                        <div>{{ $error }}</div>
                    @endforeach
                </div>
            @endif

            <form action="{{ route('password.email') }}" method="POST">
                @csrf
                <div class="premium-field">
                    <label class="premium-label">Email Address</label>
                    <input type="email" name="email" class="premium-input" placeholder="Enter your email" required value="{{ old('email') }}">
                </div>

                <button type="submit" class="btn-rajwadi">Send Reset Link</button>
            </form>

            <div class="auth-footer">
                Remember your password? <a href="{{ route('login') }}">Go to Login</a>
            </div>
        </div>
    </div>
</section>

@include('frontend.footer')
