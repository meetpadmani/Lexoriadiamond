<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Your Access Code</title>
    <style>
        body {
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            -webkit-font-smoothing: antialiased;
        }
        .container {
            max-width: 600px;
            margin: 40px auto;
            background: #ffffff;
            border-top: 4px solid #000000;
            border-bottom: 4px solid #333333;
        }
        .header {
            text-align: center;
            padding: 40px 20px;
            background-color: #0F1F17;
            color: #ffffff;
        }
        .header h1 {
            margin: 0;
            font-size: 24px;
            font-weight: 300;
            letter-spacing: 4px;
            text-transform: uppercase;
        }
        .content {
            padding: 40px;
            text-align: center;
            color: #333;
        }
        .content p {
            font-size: 16px;
            line-height: 1.6;
            margin-bottom: 20px;
            color: #555;
        }
        .otp-box {
            background-color: #fdfaf7;
            border: 2px dashed #333333;
            padding: 20px;
            margin: 30px auto;
            max-width: 300px;
            border-radius: 8px;
        }
        .otp-code {
            font-size: 36px;
            font-weight: 700;
            letter-spacing: 8px;
            color: #0F1F17;
            margin: 0;
        }
        .footer {
            padding: 30px;
            text-align: center;
            background-color: #fafafa;
            border-top: 1px solid #eee;
        }
        .footer p {
            margin: 0;
            font-size: 12px;
            color: #999;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Lexoria Diamond</h1>
        </div>
        <div class="content">
            <h2>Your Royal Access Code</h2>
            <p>Please use the following 6-digit code to access your Lexoria Diamond account. This code is valid for 10 minutes.</p>
            
            <div class="otp-box">
                <p class="otp-code">{{ $otp }}</p>
            </div>
            
            <p>If you did not request this code, please ignore this email.</p>
        </div>
        <div class="footer">
            <p>&copy; {{ date('Y') }} Lexoria Diamond. All rights reserved.</p>
        </div>
    </div>
</body>
</html>
