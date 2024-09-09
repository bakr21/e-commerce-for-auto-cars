<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to Our Website</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .email-container {
            max-width: 600px;
            margin: 20px auto;
            background-color: #ffffff;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        .email-header {
            background-color: #FFD333;
            color: #ffffff;
            padding: 20px;
            border-top-left-radius: 8px;
            border-top-right-radius: 8px;
            text-align: center;
        }
        .email-header h1 {
            margin: 0;
            font-size: 24px;
        }
        .email-body {
            padding: 20px;
        }
        .email-body h1 {
            color: #333333;
            font-size: 22px;
            margin-bottom: 20px;
        }
        .email-body p {
            color: #555555;
            line-height: 1.6;
            margin-bottom: 20px;
        }
        .email-footer {
            text-align: center;
            padding: 10px;
            font-size: 12px;
            color: #777777;
        }
        .btn {
            background-color: #FFD333;
            color: #ffffff;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
            display: inline-block;
            margin-top: 20px;
        }
        .btn:hover {
            background-color: #FFD333;
        }
        img.logo {
            max-width: 100px;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <div class="email-header">
            <img src="{{ asset('path_to_your_logo/logo.png') }}" alt="Website Logo" class="logo">
            <h1>Welcome to Our Website</h1>
        </div>
        <div class="email-body">
            <h1>Hello, {{ $user->name }}!</h1>
            <p>Thank you for registering at our website. We're excited to have you with us!</p>
            <p>If you have any questions, feel free to <a href="mailto:support@yourwebsite.com">contact us</a>.</p>
            <a href="{{ url('/') }}" class="btn">Visit Our Website</a>
        </div>
        <div class="email-footer">
            <p>&copy; 2024 Your Website. All rights reserved.</p>
        </div>
    </div>
</body>
</html>
