<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link href="{{ asset('storage/css/login_styles.css') }}" rel="stylesheet">
</head>
<body>
    @if (session('error'))
        <div class="error-message">{{ session('error') }}</div>
    @endif

    <form method="POST" action="{{ route('login') }}">
        @csrf
        <h1>Login</h1>
        <div>
            <label for="email">Email</label>
            <input type="email" id="email" name="email" value="{{ old('email') }}">
            @error('email')
                <div class="error-message">{{ $message }}</div>
            @enderror
        </div>
        <div>
            <label for="password">Password</label>
            <input type="password" id="password" name="password">
            @error('password')
                <div class="error-message">{{ $message }}</div>
            @enderror
        </div>
        <div>
            <button type="submit">Login</button>
        </div>
    </form>
</body>
</html>
