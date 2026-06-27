<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <style>
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background-color: #fdfaf7; color: #3d0a0a; margin: 0; padding: 0; }
        .container { max-width: 600px; margin: 40px auto; background-color: #ffffff; border: 1px solid #c5a059; border-radius: 0; overflow: hidden; box-shadow: 0 20px 40px rgba(61, 10, 10, 0.1); }
        .header { background-color: #3d0a0a; color: #c5a059; padding: 40px 20px; text-align: center; border-bottom: 5px double #c5a059; }
        .header h1 { font-family: 'Cinzel', serif; letter-spacing: 4px; margin: 0; font-size: 24px; text-transform: uppercase; }
        .body { padding: 50px 40px; text-align: center; line-height: 1.8; }
        .body h2 { font-family: 'Playfair Display', serif; color: #3d0a0a; font-size: 20px; margin-bottom: 20px; }
        .body p { color: #5a5a5a; font-size: 15px; margin-bottom: 30px; }
        .button { display: inline-block; padding: 18px 40px; background-color: #3d0a0a; color: #ffffff !important; text-decoration: none; font-weight: bold; font-family: 'Cinzel', serif; letter-spacing: 2px; font-size: 14px; transition: 0.3s; }
        .footer { background-color: #fdfaf7; color: #a89481; padding: 30px; text-align: center; font-size: 12px; border-top: 1px dashed #c5a059; }
        .heritage-note { font-style: italic; color: #c5a059; margin-top: 20px; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Lexoria Diamond</h1>
        </div>
        <div class="body">
            <h2>Royal Reset Mandate</h2>
            <p>Salutations, <strong>{{ $user->name }}</strong>.</p>
            <p>A request has been received from the palace to restore your access. If you did not initiate this request, you may safely ignore this scroll.</p>
            <p>To redefine your palace seal (password), please click the golden button below:</p>
            <a href="{{ route('password.reset', $token) . '?email=' . urlencode($user->email) }}" class="button">Renew Access</a>
            <p class="heritage-note">"Crafting Legacies Since 1995"</p>
        </div>
        <div class="footer">
            <p>&copy; {{ date('Y') }} Lexoria Diamond Pvt Ltd. All Rights Reserved.</p>
            <p>This mandate will expire in 60 minutes for security purposes.</p>
        </div>
    </div>
</body>
</html>
