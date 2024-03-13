<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Two-Factor Authentication Code</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            color: #333;
            padding: 20px;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #fff;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        .logo {
            text-align: center;
            margin-bottom: 20px;
        }
        .logo img {
            max-width: 200px;
        }
        .otp {
            text-align: center;
            font-size: 24px;
            margin-bottom: 20px;
        }
        .message {
            text-align: center;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>

    <div class="container">
        <div class="logo">
            <img src="{{URL::asset('/image/logo.png')}}" alt="Logo">
        </div>
        <div class="otp">
            Your Two-Factor Authentication Code is: <strong>{{ $otp }}</strong>
        </div>
        <div class="message">
            Please use this code within 1 minute for authentication purposes.
        </div>
    </div>
</body>
</html>

