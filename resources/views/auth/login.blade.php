<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login | Peak Library</title>
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
</head>
<body>

<div class="login-wrapper">
    <div class="login-card">

        <div class="login-header">
            <img src="{{ asset('img/logo.jpeg') }}" alt="Peak Library Logo">
            <h2>Peak Library</h2>
            <p>Silakan login untuk melanjutkan</p>
        </div>

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" required autofocus>
            </div>

            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" required>
            </div>

            <div class="form-extra">
                <label class="remember">
                    <input type="checkbox" name="remember">
                    Remember me
                </label>

                <a href="{{ route('password.request') }}">Lupa password?</a>
            </div>

            <button type="submit" class="btn-login">
                Login
            </button>
        </form>

        <div class="login-footer">
            <span>Belum punya akun?</span>
            <a href="{{ route('register') }}">Daftar</a>
        </div>

    </div>
</div>

</body>
</html>
