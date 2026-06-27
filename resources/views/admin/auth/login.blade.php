<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login | Meet</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,700;1,400&family=Outfit:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        :root {
            --royal-red: #1a4325;
            --royal-red-dark: #0a1c0f;
            --accent-gold: #b58d55;
            --cream-bg: #f7efe6;
            --text-dark: #2a0c0c;
        }

        body {
            background-color: var(--royal-red-dark);
            background-image: 
                radial-gradient(circle at 0% 0%, rgba(181, 141, 85, 0.1) 0%, transparent 50%),
                radial-gradient(circle at 100% 100%, rgba(181, 141, 85, 0.1) 0%, transparent 50%),
                url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M30 0L60 30L30 60L0 30Z' fill='none' stroke='%23b58d55' stroke-opacity='0.05' stroke-width='1'/%3E%3C/svg%3E");
            font-family: 'Outfit', sans-serif;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            margin: 0;
        }

        .login-card {
            background: var(--cream-bg);
            width: 100%;
            max-width: 450px;
            padding: 50px 40px;
            border-radius: 30px;
            box-shadow: 0 25px 50px rgba(0,0,0,0.5);
            position: relative;
            border: 2px solid var(--accent-gold);
            animation: slideUp 0.8s cubic-bezier(0.165, 0.84, 0.44, 1);
        }

        @keyframes slideUp {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .login-card::before {
            content: '❖';
            position: absolute;
            top: -20px;
            left: 50%;
            transform: translateX(-50%);
            background: var(--royal-red);
            color: var(--accent-gold);
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 2px solid var(--accent-gold);
            font-size: 1.2rem;
            box-shadow: 0 5px 15px rgba(0,0,0,0.3);
        }

        .brand-logo {
            text-align: center;
            margin-bottom: 35px;
        }

        .brand-logo h1 {
            font-family: 'Playfair Display', serif;
            color: var(--royal-red);
            font-size: 2.2rem;
            font-weight: 700;
            margin: 0;
        }

        .brand-logo span {
            display: block;
            text-transform: uppercase;
            letter-spacing: 4px;
            font-size: 0.7rem;
            color: var(--accent-gold);
            margin-top: 5px;
            font-weight: 600;
        }

        .form-label {
            color: var(--text-dark);
            font-weight: 600;
            font-size: 0.85rem;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 8px;
        }

        .form-control {
            background: #fff;
            border: 1.5px solid rgba(181, 141, 85, 0.3);
            border-radius: 12px;
            padding: 12px 15px;
            font-size: 0.95rem;
            color: var(--text-dark);
            transition: all 0.3s ease;
        }

        .form-control:focus {
            border-color: var(--accent-gold);
            box-shadow: 0 0 0 4px rgba(181, 141, 85, 0.1);
            background: #fff;
        }

        .btn-login {
            background: var(--royal-red);
            color: #fff;
            border: none;
            border-radius: 12px;
            padding: 14px;
            width: 100%;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 2px;
            margin-top: 25px;
            transition: all 0.3s ease;
            box-shadow: 0 10px 20px rgba(90, 25, 25, 0.2);
        }

        .btn-login:hover {
            background: var(--royal-red-dark);
            transform: translateY(-2px);
            box-shadow: 0 15px 30px rgba(90, 25, 25, 0.3);
            color: #fff;
        }

        .input-group-text {
            background: transparent;
            border: 1.5px solid rgba(181, 141, 85, 0.3);
            border-right: none;
            color: var(--accent-gold);
            border-radius: 12px 0 0 12px;
        }

        .input-group .form-control {
            border-left: none;
            border-radius: 0 12px 12px 0;
        }

        .back-to-site {
            text-align: center;
            margin-top: 25px;
        }

        .back-to-site a {
            color: var(--accent-gold);
            text-decoration: none;
            font-size: 0.85rem;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .back-to-site a:hover {
            color: var(--royal-red);
        }

        .alert {
            border-radius: 12px;
            font-size: 0.85rem;
            border: none;
            margin-bottom: 25px;
        }

        /* Decorative Corners */
        .corner {
            position: absolute;
            width: 30px;
            height: 30px;
            border: 1px solid var(--accent-gold);
            opacity: 0.4;
        }
        .top-left { top: 20px; left: 20px; border-right: none; border-bottom: none; }
        .top-right { top: 20px; right: 20px; border-left: none; border-bottom: none; }
        .bottom-left { bottom: 20px; left: 20px; border-right: none; border-top: none; }
        .bottom-right { bottom: 20px; right: 20px; border-left: none; border-top: none; }
    </style>
</head>
<body>

    <div class="login-card">
        <div class="corner top-left"></div>
        <div class="corner top-right"></div>
        <div class="corner bottom-left"></div>
        <div class="corner bottom-right"></div>

        <div class="brand-logo">
            <h1>MEET</h1>
            <span>Diamond Management Studio</span>
        </div>

        @if($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0 list-unstyled">
                    @foreach($errors->all() as $error)
                        <li><i class="bi bi-exclamation-circle me-2"></i> {{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.login.submit') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label class="form-label">Email Address</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                    <input type="email" name="email" class="form-control" placeholder="admin@meet.com" required autofocus>
                </div>
            </div>

            <div class="mb-4">
                <label class="form-label">Password</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-lock"></i></span>
                    <input type="password" name="password" class="form-control" placeholder="••••••••" required>
                </div>
            </div>

            <div class="d-flex justify-content-between align-items-center mb-4">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="remember" id="remember" style="accent-color: var(--royal-red);">
                    <label class="form-check-label text-muted small" for="remember">
                        Remember Session
                    </label>
                </div>
            </div>

            <button type="submit" class="btn btn-login">
                Access Studio <i class="bi bi-arrow-right ms-2"></i>
            </button>
        </form>

        <div class="back-to-site">
            <a href="/">
                <i class="bi bi-house-door me-1"></i> Return to Main Website
            </a>
        </div>
    </div>

</body>
</html>
