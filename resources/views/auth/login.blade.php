<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Login | Expense Tracker</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
</head>

<body class="bg-light d-flex align-items-center justify-content-center vh-100">

    <div class="card shadow-lg p-4" style="width: 400px; border-radius: 15px;">
        <div class="text-center mb-4">
            <i class="bi bi-wallet2 fs-1 text-primary"></i>
            <h4 class="mt-2">Expense Tracker Login</h4>
        </div>

        @if($errors->any())
        <div class="alert alert-danger">
            {{ $errors->first() }}
        </div>
        @endif

        <form method="POST" action="{{ url('/login') }}">
            @csrf
            <div class="mb-3">
                <label class="form-label">Email address</label>
                <input type="email" name="email" class="form-control" placeholder="Enter email" required autofocus>
            </div>
            <div class="mb-3">
                <label class="form-label">Password</label>
                <input type="password" name="password" class="form-control" placeholder="Enter password" required>
            </div>
            <button type="submit" class="btn btn-primary w-100 mb-3">
                <i class="bi bi-box-arrow-in-right"></i> Login
            </button>
        </form>

        <!-- Register Button -->
        <div class="text-center mb-2">
            <a href="{{ route('register') }}" class="btn btn-success w-100">
                <i class="bi bi-person-plus"></i> Register
            </a>
        </div>


        <!-- Note -->
        <p class="text-center text-muted small">
            If you don’t have an account, please register first.
        </p>

    </div>

</body>

</html>