<x-guest-layout>
    <!-- ربط ملف CSS -->
    <link rel="stylesheet" href="{{ asset('css/reg.css') }}">

    <div style="text-align: center;">
        <div class="header-box">
            متجر أريج
        </div>
    </div>

    @if (session('status'))
        <div class="status">{{ session('status') }}</div>
    @endif

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- الاسم -->
        <label for="name">الاسم:</label>
        <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus autocomplete="name">
        @error('name')
            <div class="error">{{ $message }}</div>
        @enderror

        <!-- البريد الإلكتروني -->
        <label for="email">البريد الإلكتروني:</label>
        <input id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="username">
        @error('email')
            <div class="error">{{ $message }}</div>
        @enderror

        <!-- كلمة المرور -->
        <label for="password">كلمة المرور:</label>
        <input id="password" type="password" name="password" required autocomplete="new-password">
        @error('password')
            <div class="error">{{ $message }}</div>
        @enderror

        <!-- تأكيد كلمة المرور -->
        <label for="password_confirmation">تأكيد كلمة المرور:</label>
        <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password">
        @error('password_confirmation')
            <div class="error">{{ $message }}</div>
        @enderror

        <button type="submit">تسجيل</button>
    </form>

    <div class="mt-4 text-center">
        <a href="{{ route('login') }}" class="register-button">
            لديك حساب؟ تسجيل الدخول
        </a>
    </div>
</x-guest-layout>
