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
            background: #0f1117;
            overflow: hidden;
        }

        /* Left Panel - Branding */
        .login-branding {
            flex: 1;
            background: linear-gradient(135deg, #1a1d27 0%, #0f1117 100%);
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
            width: 500px; height: 500px;
            background: radial-gradient(circle, rgba(99, 102, 241, 0.08) 0%, transparent 70%);
            top: 50%; left: 50%;
            transform: translate(-50%, -50%);
        }

        .login-branding::after {
            content: '';
            position: absolute;
            width: 300px; height: 300px;
            background: radial-gradient(circle, rgba(197, 160, 89, 0.06) 0%, transparent 70%);
            bottom: 10%; right: 10%;
        }

        .branding-content {
            position: relative;
            z-index: 1;
            text-align: center;
            max-width: 400px;
        }

        .branding-icon {
            width: 80px; height: 80px;
            background: linear-gradient(135deg, #6366f1, #c5a059);
            border-radius: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2.2rem;
            color: white;
            margin: 0 auto 30px;
            box-shadow: 0 20px 40px rgba(99, 102, 241, 0.15);
        }

        .branding-content h1 {
            font-size: 2.5rem;
            font-weight: 700;
            color: #e2e8f0;
            letter-spacing: 3px;
            margin-bottom: 8px;
        }

        .branding-content .tagline {
            font-size: 0.85rem;
            color: #6366f1;
            text-transform: uppercase;
            letter-spacing: 3px;
            font-weight: 600;
            margin-bottom: 30px;
        }

        .branding-content p {
            font-size: 1rem;
            color: #64748b;
            line-height: 1.7;
        }

        .branding-features {
            margin-top: 40px;
            display: flex;
            flex-direction: column;
            gap: 14px;
        }

        .branding-features .feature {
            display: flex;
            align-items: center;
            gap: 12px;
            color: #94a3b8;
            font-size: 0.9rem;
        }

        .branding-features .feature i {
            color: #6366f1;
            font-size: 1.1rem;
        }

        /* Right Panel - Form */
        .login-form-panel {
            width: 480px;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 40px;
            background: #1a1d27;
            border-left: 1px solid #2d3148;
        }

        .login-form-wrapper {
            width: 100%;
            max-width: 360px;
        }

        .login-form-wrapper h2 {
            font-size: 1.5rem;
            font-weight: 700;
            color: #e2e8f0;
            margin-bottom: 6px;
        }

        .login-form-wrapper .subtitle {
            color: #64748b;
            font-size: 0.9rem;
            margin-bottom: 36px;
        }

        .form-group {
            margin-bottom: 22px;
        }

        .form-group label {
            font-size: 0.8rem;
            font-weight: 600;
            color: #94a3b8;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 8px;
            display: block;
        }

        .input-wrapper {
            position: relative;
        }

        .input-wrapper i {
            position: absolute;
            left: 14px; top: 50%;
            transform: translateY(-50%);
            color: #64748b;
            font-size: 1rem;
        }

        .form-input {
            width: 100%;
            padding: 12px 14px 12px 42px;
            background: #0f1117;
            border: 1px solid #2d3148;
            border-radius: 8px;
            color: #e2e8f0;
            font-size: 0.9rem;
            font-family: 'Inter', sans-serif;
            transition: all 0.2s;
        }

        .form-input:focus {
            outline: none;
            border-color: #6366f1;
            box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.12);
        }

        .form-input::placeholder { color: #475569; }

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
            color: #94a3b8;
            font-size: 0.85rem;
        }

        .remember-check input[type="checkbox"] {
            accent-color: #6366f1;
        }

        .login-btn {
            width: 100%;
            padding: 14px;
            background: #6366f1;
            border: none;
            border-radius: 8px;
            color: white;
            font-size: 0.95rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s;
            font-family: 'Inter', sans-serif;
        }

        .login-btn:hover {
            background: #818cf8;
            transform: translateY(-1px);
            box-shadow: 0 8px 20px rgba(99, 102, 241, 0.25);
        }

        .error-box {
            background: rgba(239, 68, 68, 0.1);
            border: 1px solid rgba(239, 68, 68, 0.2);
            color: #ef4444;
            padding: 12px 16px;
            border-radius: 8px;
            margin-bottom: 20px;
            font-size: 0.85rem;
        }

        .admin-link {
            text-align: center;
            margin-top: 24px;
            font-size: 0.85rem;
            color: #64748b;
        }

        .admin-link a {
            color: #6366f1;
            text-decoration: none;
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
        <div class="branding-content">
            <div class="branding-icon"><i class="bi bi-gem"></i></div>
            <h1>LEXORIA</h1>
            <div class="tagline">CRM Platform</div>
            <p>Manage your leads, clients, projects, and invoices — all in one place.</p>
            <div class="branding-features">
                <div class="feature"><i class="bi bi-check-circle-fill"></i> Lead Pipeline & Kanban Board</div>
                <div class="feature"><i class="bi bi-check-circle-fill"></i> Client & Project Management</div>
                <div class="feature"><i class="bi bi-check-circle-fill"></i> Quotations & GST Invoicing</div>
                <div class="feature"><i class="bi bi-check-circle-fill"></i> WhatsApp Integration</div>
                <div class="feature"><i class="bi bi-check-circle-fill"></i> Designer Assignment & CAD Files</div>
            </div>
        </div>
    </div>

    <div class="login-form-panel">
        <div class="login-form-wrapper">
            <h2>Welcome back</h2>
            <p class="subtitle">Sign in to your CRM workspace</p>

            @if($errors->any())
                <div class="error-box">
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

                <button type="submit" class="login-btn">Sign In</button>
            </form>

            <div class="admin-link">
                <a href="{{ route('admin.login') }}">Go to Admin Panel →</a>
            </div>
        </div>
    </div>
</body>
</html>
