<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forget Password Verification</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Linking to the external CSS file -->
    <link rel="stylesheet" href="{{ asset('css/logintwo.css') }}">
    <style>
        /* Any additional styles can be added here */
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="container" id="container">
                    <div class="form-container sign-in">
                        <h1 class="text-center">Forget Password Verification</h1>
                        <p class="text-center">Enter your verification code</p>
                        <div class="input-box">
                            <form method="POST" action="{{ route('password.verify') }}">
                                <input type="hidden" name="email" value="{{ session('email') }}">
                                @csrf
                                <div class="form-group">
                                    <input id="verification_code" type="text" class="form-control " name="verification_code" required autofocus placeholder="Verification Code">
                                    @error('verification_code')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                @if ($errors->has('verification_code'))
                                    <div class="alert alert-danger" role="alert">
                                        {{ $errors->first('verification_code') }}
                                    </div>
                                @endif
                                <div class="form-group mb-0">
                                    <button type="submit" class="btn btn-primary btn-block">Verify</button>


                            </form>
                            <div class="mt-3 text-center">
                                <form method="POST" action="{{ route('forgot_password_otp.resend') }}">
                                    @csrf
                                    <input type="hidden" name="email" value="{{ session('email') }}">
                                    <button type="submit" class="btn btn-primary btn-block">Resend Code</button>
                                </form>
                            </div>
                            </div>
                        </div>
                    </div>
                    <div class="toggle-container">
                        <div class="toggle">
                            <div class="toggle-panel toggle-right">
                                <h1>Hello, Friend!</h1>
                                <p>Welcome to Forgot Password Verification page</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
