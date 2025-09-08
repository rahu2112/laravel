<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Register</title>
    <style>
    body {
        font-family: Arial, sans-serif;
        background: #f5f5f5;
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 100vh;
        margin: 0;
    }

    .container {
        width: 420px;
        background: #fff;
        padding: 25px 30px;
        border-radius: 10px;
        box-shadow: 0 6px 20px rgba(0, 0, 0, 0.1);
    }

    h2 {
        text-align: center;
        margin-bottom: 20px;
        color: #333;
    }

    input,
    select,
    button {
        width: 100%;
        padding: 10px 12px;
        margin: 8px 0;
        border-radius: 6px;
        border: 1px solid #ccc;
        box-sizing: border-box;
    }

    button {
        background: #2d8cf0;
        color: #fff;
        font-weight: bold;
        cursor: pointer;
        border: none;
        transition: 0.3s;
    }

    button:hover {
        background: #1677d2;
    }

    .success {
        color: green;
        text-align: center;
        margin-bottom: 15px;
    }

    .error {
        color: red;
        font-size: 13px;
        margin-top: -6px;
        margin-bottom: 6px;
    }

    .login-link {
        text-align: center;
        margin-top: 12px;
        font-size: 14px;
    }

    .login-link a {
        color: #2d8cf0;
        text-decoration: none;
    }

    .login-link a:hover {
        text-decoration: underline;
    }
    </style>
</head>

<body>
    <div class="container">
        <h2>User Register</h2>

        @if(session('success'))
        <p class="success">{{ session('success') }}</p>
        @endif

        <form action="{{ route('register') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <input type="text" name="name" placeholder="Full Name" value="{{ old('name') }}" required>
            @error('name') <p class="error">{{ $message }}</p> @enderror

            <input type="email" name="email" placeholder="Email" value="{{ old('email') }}" required>
            @error('email') <p class="error">{{ $message }}</p> @enderror

            <input type="password" name="password" placeholder="Password" required>
            @error('password') <p class="error">{{ $message }}</p> @enderror

            <input type="text" name="phone" placeholder="Phone Number" value="{{ old('phone') }}">
            @error('phone') <p class="error">{{ $message }}</p> @enderror

            <input type="text" name="address" placeholder="Address" value="{{ old('address') }}">
            @error('address') <p class="error">{{ $message }}</p> @enderror

            <input type="date" name="dob" value="{{ old('dob') }}">
            @error('dob') <p class="error">{{ $message }}</p> @enderror

            <select name="gender">
                <option value="">-- Select Gender --</option>
                <option value="male" {{ old('gender')=='male' ? 'selected':'' }}>Male</option>
                <option value="female" {{ old('gender')=='female' ? 'selected':'' }}>Female</option>
                <option value="other" {{ old('gender')=='other' ? 'selected':'' }}>Other</option>
            </select>
            @error('gender') <p class="error">{{ $message }}</p> @enderror

            <input type="file" name="profile_photo">
            @error('profile_photo') <p class="error">{{ $message }}</p> @enderror

            <button type="submit">Register</button>
        </form>

        <div class="login-link">
            Already have an account? <a href="{{ route('login') }}">Login Here</a>
        </div>
    </div>
</body>

</html>