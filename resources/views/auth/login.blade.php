<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title> متجر أريج</title>
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
</head>
<body><div style="text-align: center;">
    <div class="header-box">
          متجر أريج
    </div>
</div>


        @if (session('status'))
            <div class="status">{{ session('status') }}</div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <label for="email">البريد الإلكتروني:</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus>

            @error('email')
                <div class="error">{{ $message }}</div>
            @enderror

            <label for="password">كلمة المرور:</label>
            <input id="password" type="password" name="password" required>

            @error('password')
                <div class="error">{{ $message }}</div>
            @enderror

            <div class="remember">
                <input type="checkbox" name="remember" id="remember">
                <label for="remember">تذكرني</label>
            </div>

            <button type="submit">تسجيل الدخول</button>

            @if (Route::has('password.request'))
                <a class="forgot" href="{{ route('password.request') }}">نسيت كلمة المرور؟</a>
            @endif
            <div class="mt-4 text-center">
    <a href="{{ route('register') }}" class="register-button">
        تسجيل حساب جديد
    </a>
</div>

        </form>
    </div>

</body>
</html>
