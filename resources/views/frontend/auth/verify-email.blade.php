@include('frontend.navbar')

<style>
    .verify-page {
        min-height: calc(100vh - 100px);
        display: flex;
        align-items: center;
        justify-content: center;
        position: relative;
        background: #0d0a06;
        padding: 60px 20px;
        overflow: hidden;
    }

    .verify-bg {
        position: absolute;
        inset: 0;
        background-image: 
            radial-gradient(circle at 50% 50%, rgba(181, 141, 85, 0.1) 0%, transparent 60%),
            url("https://images.unsplash.com/photo-1603974372039-adc49044b6bb?q=80&w=2000&auto=format&fit=crop");
        background-size: cover;
        background-position: center;
        opacity: 0.3;
        z-index: 0;
    }

    .verify-bg::after {
        content: '';
        position: absolute;
        inset: 0;
        background: linear-gradient(180deg, rgba(13, 10, 6, 0.9) 0%, rgba(13, 10, 6, 0.6) 50%, rgba(13, 10, 6, 0.9) 100%);
    }

    .verify-card {
        position: relative;
        z-index: 10;
        background: rgba(255, 255, 255, 0.03);
        backdrop-filter: blur(16px);
        -webkit-backdrop-filter: blur(16px);
        border: 1px solid rgba(181, 141, 85, 0.2);
        border-radius: 24px;
        padding: 60px 50px;
        max-width: 580px;
        width: 100%;
        text-align: center;
        box-shadow: 0 30px 60px rgba(0, 0, 0, 0.4), inset 0 0 0 1px rgba(255, 255, 255, 0.05);
        animation: scaleUp 0.8s cubic-bezier(0.165, 0.84, 0.44, 1) both;
    }

    @keyframes scaleUp {
        0% { opacity: 0; transform: scale(0.95) translateY(20px); }
        100% { opacity: 1; transform: scale(1) translateY(0); }
    }

    .verify-icon-wrapper {
        width: 100px;
        height: 100px;
        background: linear-gradient(135deg, rgba(181, 141, 85, 0.1), rgba(181, 141, 85, 0.05));
        border: 1px solid rgba(181, 141, 85, 0.3);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 30px;
        position: relative;
        box-shadow: 0 0 30px rgba(181, 141, 85, 0.1);
    }
    
    .verify-icon-wrapper::before {
        content: '';
        position: absolute;
        inset: -10px;
        border: 1px dashed rgba(181, 141, 85, 0.4);
        border-radius: 50%;
        animation: spinSlow 15s linear infinite;
    }

    @keyframes spinSlow {
        100% { transform: rotate(360deg); }
    }

    .verify-icon {
        font-size: 2.8rem;
        color: var(--brand-gold, #b58d55);
        filter: drop-shadow(0 2px 8px rgba(181, 141, 85, 0.4));
    }

    .verify-title {
        font-family: var(--heading-font, 'Playfair Display', serif);
        font-size: 2.5rem;
        color: #ffffff;
        margin-bottom: 15px;
        letter-spacing: 2px;
        font-weight: 400;
    }

    .verify-subtitle {
        color: #b8a88a;
        font-size: 1.05rem;
        line-height: 1.7;
        margin-bottom: 35px;
        font-weight: 300;
    }

    .alert-success {
        background: rgba(47, 133, 90, 0.1);
        color: #68d391;
        padding: 16px;
        border-radius: 12px;
        margin-bottom: 25px;
        font-size: 0.95rem;
        border: 1px solid rgba(104, 211, 145, 0.2);
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
    }

    .btn-verify-primary {
        width: 100%;
        background: linear-gradient(135deg, #c9a84c, #b58d55);
        color: #ffffff;
        border: none;
        padding: 18px;
        border-radius: 12px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 2px;
        font-size: 0.9rem;
        cursor: pointer;
        transition: all 0.3s ease;
        box-shadow: 0 10px 20px rgba(181, 141, 85, 0.2);
    }

    .btn-verify-primary:hover {
        background: linear-gradient(135deg, #d4b45a, #c4995c);
        transform: translateY(-3px);
        box-shadow: 0 15px 30px rgba(181, 141, 85, 0.4);
    }

    .btn-verify-secondary {
        width: 100%;
        background: transparent;
        color: #b8a88a;
        border: 1px solid rgba(181, 141, 85, 0.3);
        padding: 18px;
        border-radius: 12px;
        font-weight: 500;
        text-transform: uppercase;
        letter-spacing: 2px;
        font-size: 0.85rem;
        cursor: pointer;
        transition: all 0.3s ease;
        margin-top: 15px;
    }

    .btn-verify-secondary:hover {
        background: rgba(181, 141, 85, 0.1);
        color: #ffffff;
        border-color: rgba(181, 141, 85, 0.6);
    }

    .verify-footer {
        margin-top: 35px;
        font-size: 0.85rem;
        color: #666;
        border-top: 1px solid rgba(255, 255, 255, 0.05);
        padding-top: 25px;
    }

    @media (max-width: 768px) {
        .verify-card {
            padding: 40px 30px;
        }
        .verify-title {
            font-size: 2rem;
        }
    }
</style>

<section class="verify-page">
    <div class="verify-bg"></div>
    
    <div class="verify-card">
        <div class="verify-icon-wrapper">
            <i class="bi bi-envelope-paper-heart verify-icon"></i>
        </div>
        
        <h1 class="verify-title">Verify Your Identity</h1>
        
        <p class="verify-subtitle">
            Welcome to the exclusive world of Lexoria. Before you begin exploring our exquisite collections, we must verify your email address. 
            A royal seal of verification has been sent to your inbox.
        </p>

        @if (session('success'))
            <div class="alert-success">
                <i class="bi bi-check-circle-fill"></i>
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('verification.send') }}" method="POST">
            @csrf
            <button type="submit" class="btn-verify-primary">Resend Verification Scroll</button>
        </form>

        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="btn-verify-secondary">Return to Palace Doors (Logout)</button>
        </form>

        <div class="verify-footer">
            If you did not receive the email, kindly check your spam folder or request a new one.
        </div>
    </div>
</section>

@include('frontend.footer')


