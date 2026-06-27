<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lexoria CRM - Login</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: 'Inter', sans-serif;
            min-height: 100vh;
            display: flex;
            background: #f1f5f9;
            overflow: hidden;
        }

        /* Left Panel - Branding */
        .login-branding {
            flex: 1;
            background: linear-gradient(135deg, #6366f1 0%, #4f46e5 40%, #7c3aed 100%);
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 60px;
            position: relative;
            overflow: hidden;
        }

        .login-branding::before {
            content: '';
            position: absolute;
            width: 600px; height: 600px;
            background: radial-gradient(circle, rgba(255,255,255,0.08) 0%, transparent 70%);
            top: 50%; left: 50%;
            transform: translate(-50%, -50%);
        }

        .login-branding::after {
            content: '';
            position: absolute;
            width: 300px; height: 300px;
            background: radial-gradient(circle, rgba(255,255,255,0.06) 0%, transparent 70%);
            bottom: 10%; right: 10%;
        }

        /* Decorative circles */
        .deco-circle {
            position: absolute;
            border-radius: 50%;
            border: 1px solid rgba(255,255,255,0.1);
        }
        .deco-circle-1 { width: 400px; height: 400px; top: -100px; left: -100px; }
        .deco-circle-2 { width: 250px; height: 250px; bottom: -50px; right: -50px; }

        .branding-content {
            position: relative;
            z-index: 1;
            text-align: center;
            max-width: 420px;
        }

        .branding-icon {
            width: 80px; height: 80px;
            background: rgba(255,255,255,0.15);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255,255,255,0.2);
            border-radius: 22px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2.2rem;
            color: white;
            margin: 0 auto 30px;
            box-shadow: 0 20px 40px rgba(0,0,0,0.15);
        }

        .branding-content h1 {
            font-size: 2.8rem;
            font-weight: 700;
            color: white;
            letter-spacing: 4px;
            margin-bottom: 8px;
        }

        .branding-content .tagline {
            font-size: 0.82rem;
            color: rgba(255,255,255,0.7);
            text-transform: uppercase;
            letter-spacing: 3px;
            font-weight: 600;
            margin-bottom: 28px;
        }

        .branding-content p {
            font-size: 0.95rem;
            color: rgba(255,255,255,0.75);
            line-height: 1.7;
        }

        .branding-features {
            margin-top: 40px;
            display: flex;
            flex-direction: column;
            gap: 14px;
            text-align: left;
        }

        .branding-features .feature {
            display: flex;
            align-items: center;
            gap: 12px;
            color: rgba(255,255,255,0.85);
            font-size: 0.875rem;
            background: rgba(255,255,255,0.08);
            padding: 10px 16px;
            border-radius: 10px;
            border: 1px solid rgba(255,255,255,0.1);
        }

        .branding-features .feature i {
            color: rgba(255,255,255,0.9);
            font-size: 1rem;
            background: rgba(255,255,255,0.15);
            width: 28px; height: 28px;
            border-radius: 7px;
            display: flex; align-items: center; justify-content: center;
            flex-shrink: 0;
        }

        /* Right Panel - Form */
        .login-form-panel {
            width: 500px;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 48px 40px;
            background: #ffffff;
            border-left: 1px solid #e2e8f0;
            box-shadow: -4px 0 30px rgba(0,0,0,0.04);
        }

        .login-form-wrapper {
            width: 100%;
            max-width: 380px;
        }

        .login-logo-sm {
            width: 44px; height: 44px;
            background: linear-gradient(135deg, #6366f1, #8b5cf6);
            border-radius: 12px;
            display: flex; align-items: center; justify-content: center;
            font-size: 1.3rem; color: white;
            margin-bottom: 28px;
            box-shadow: 0 6px 16px rgba(99,102,241,0.3);
        }

        .login-form-wrapper h2 {
            font-size: 1.6rem;
            font-weight: 700;
            color: #0f172a;
            margin-bottom: 6px;
        }

        .login-form-wrapper .subtitle {
            color: #94a3b8;
            font-size: 0.9rem;
            margin-bottom: 36px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            font-size: 0.78rem;
            font-weight: 600;
            color: #475569;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 7px;
            display: block;
        }

        .input-wrapper {
            position: relative;
        }

        .input-wrapper i {
            position: absolute;
            left: 14px; top: 50%;
            transform: translateY(-50%);
            color: #94a3b8;
            font-size: 1rem;
        }

        .form-input {
            width: 100%;
            padding: 12px 14px 12px 42px;
            background: #f8fafc;
            border: 1.5px solid #e2e8f0;
            border-radius: 10px;
            color: #0f172a;
            font-size: 0.9rem;
            font-family: 'Inter', sans-serif;
            transition: all 0.2s;
        }

        .form-input:focus {
            outline: none;
            border-color: #6366f1;
            background: #ffffff;
            box-shadow: 0 0 0 4px rgba(99, 102, 241, 0.08);
        }

        .form-input::placeholder { color: #cbd5e1; }

        .form-options {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 28px;
        }

        .remember-check {
            display: flex;
            align-items: center;
            gap: 8px;
            color: #64748b;
            font-size: 0.85rem;
            cursor: pointer;
        }

        .remember-check input[type="checkbox"] {
            accent-color: #6366f1;
            width: 15px; height: 15px;
        }

        .login-btn {
            width: 100%;
            padding: 14px;
            background: linear-gradient(135deg, #6366f1, #8b5cf6);
            border: none;
            border-radius: 10px;
            color: white;
            font-size: 0.95rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.25s;
            font-family: 'Inter', sans-serif;
            box-shadow: 0 6px 16px rgba(99,102,241,0.3);
        }

        .login-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 12px 24px rgba(99, 102, 241, 0.35);
        }

        .login-btn:active { transform: translateY(0); }

        .error-box {
            background: #fef2f2;
            border: 1px solid #fecaca;
            color: #dc2626;
            padding: 12px 16px;
            border-radius: 10px;
            margin-bottom: 20px;
            font-size: 0.85rem;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .admin-link {
            text-align: center;
            margin-top: 28px;
            padding-top: 24px;
            border-top: 1px solid #f1f5f9;
            font-size: 0.85rem;
            color: #94a3b8;
        }

        .admin-link a {
            color: #6366f1;
            text-decoration: none;
            font-weight: 500;
        }

        .admin-link a:hover { text-decoration: underline; }

        @media (max-width: 992px) {
            .login-branding { display: none; }
            .login-form-panel {
                width: 100%;
                border-left: none;
            }
        }
    </style>
</head>
<body>
    <div class="login-branding">
        <div class="deco-circle deco-circle-1"></div>
        <div class="deco-circle deco-circle-2"></div>
        <div class="branding-content">
            <div class="branding-icon"><i class="bi bi-gem"></i></div>
            <h1>LEXORIA</h1>
            <div class="tagline">CRM Platform</div>
            <p>Manage your leads, clients, projects, and invoices — all in one place.</p>
            <div class="branding-features">
                <div class="feature"><i class="bi bi-funnel-fill"></i> Lead Pipeline & Kanban Board</div>
                <div class="feature"><i class="bi bi-people-fill"></i> Client & Project Management</div>
                <div class="feature"><i class="bi bi-file-earmark-text-fill"></i> Quotations & GST Invoicing</div>
                <div class="feature"><i class="bi bi-whatsapp"></i> WhatsApp Integration</div>
                <div class="feature"><i class="bi bi-bar-chart-fill"></i> Analytics & Reports</div>
            </div>
        </div>
    </div>

    <div class="login-form-panel">
        <div class="login-form-wrapper">
            <div class="login-logo-sm"><i class="bi bi-gem"></i></div>
            <h2>Welcome back</h2>
            <p class="subtitle">Sign in to your CRM workspace</p>

            @if($errors->any())
                <div class="error-box">
                    <i class="bi bi-exclamation-circle-fill"></i>
                    @foreach($errors->all() as $error)
                        {{ $error }}
                    @endforeach
                </div>
            @endif

            <form method="POST" action="{{ route('crm.login.submit') }}">
                @csrf
                <div class="form-group">
                    <label>Email Address</label>
                    <div class="input-wrapper">
                        <i class="bi bi-envelope"></i>
                        <input type="email" name="email" class="form-input" placeholder="admin@lexoria.com" value="{{ old('email') }}" required autofocus>
                    </div>
                </div>

                <div class="form-group">
                    <label>Password</label>
                    <div class="input-wrapper">
                        <i class="bi bi-lock"></i>
                        <input type="password" name="password" class="form-input" placeholder="••••••••" required>
                    </div>
                </div>

                <div class="form-options">
                    <label class="remember-check">
                        <input type="checkbox" name="remember">
                        Remember me
                    </label>
                </div>

                <button type="submit" class="login-btn">
                    <i class="bi bi-box-arrow-in-right me-2"></i> Sign In to CRM
                </button>
            </form>

            <div class="admin-link">
                <a href="{{ route('admin.login') }}">← Go to Admin Panel</a>
            </div>
        </div>
    </div>
</body>
</html>
