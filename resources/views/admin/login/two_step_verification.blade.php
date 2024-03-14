<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Two-Step Verification</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('css/logintwo.css') }}"> <!-- Reusing the same CSS as login.blade.php -->
    <style>
.error-message {
    position: absolute;
    bottom: -0.5rem;
    left: 0;
}
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="container" id="container">
                    <div class="form-container sign-in">
                        <h1 class="text-center">Two-Step Verification</h1>
                        <p class="text-center mb-0">Enter your verification code</p>

                        <form method="POST" action="{{ route('two-step.verify') }}">
                            @csrf

                            <div class="input-error-container">
                                <div class="input-box">
                                    <div class="form-group">
                                        <input id="verification_code" type="text" class="form-control @error('verification_code') is-invalid @enderror" name="verification_code" required autofocus placeholder="Verification Code">
                                    </div>
                                </div>
                            @if ($errors->any())

                                        @foreach ($errors->all() as $error)
                                            <li class="error-message">{{ $error }}</li>
                                        @endforeach
                            @endif


                        </div>
                            <div class="button-box">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary btn-block">Verify</button>

                        </form>
                        <form method="POST" action="{{ route('two-step.resend') }}">
                                @csrf

                                <div class="form-group">
                                    <button type="submit" class="btn btn-link">Resend Code</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    </div>
                    <div class="toggle-container">
                        <div class="toggle">
                            <div class="toggle-panel toggle-right">
                                <h1>Hello, Friend!</h1>
                                <p>Welcome Back</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
