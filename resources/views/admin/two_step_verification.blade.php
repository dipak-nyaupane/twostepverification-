<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Two-Step Verification</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .container {
            margin-top: 100px;
        }
        .card {
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">Two-Step Verification</div>
                    <div class="card-body">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form method="POST" action="{{ route('two-step.verify') }}">
                            @csrf

                            <div class="form-group">
                                <label for="verification_code">Verification Code</label>
                                <input id="verification_code" type="text" class="form-control" name="verification_code" required autofocus>
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-primary btn-block">Verify</button>
                            </div>
                        </form>

                        <form method="POST" action="{{ route('two-step.resend') }}">
                            @csrf

                            <div class="form-group mb-0">
                                <button type="submit" class="btn btn-link">Resend Verification Code</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
