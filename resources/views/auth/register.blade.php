<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Register | Peak Library</title>
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
</head>
<body>

<div class="login-wrapper">
    <div class="login-card">

        <div class="login-header">
            <img src="{{ asset('img/logo.jpeg') }}" alt="Peak Library Logo">
            <h2>Peak Library</h2>
            <p>Buat akun baru untuk melanjutkan</p>
        </div>

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div class="form-group">
                <label>Nama Lengkap</label>
                <input type="text" name="name" value="{{ old('name') }}" required>
                @error('name')
                    <small class="error">{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" value="{{ old('email') }}" required>
                @error('email')
                    <small class="error">{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" required>
                @error('password')
                    <small class="error">{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group">
                <label>Konfirmasi Password</label>
                <input type="password" name="password_confirmation" required>
            </div>

            <button type="submit" class="btn-login">
                Register
            </button>
        </form>

        <div class="login-footer">
            <span>Sudah punya akun?</span>
            <a href="{{ route('login') }}">Login</a>
        </div>

    </div>
</div>

</body>
</html>
