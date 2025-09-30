<x-app-layout>
    <x-slot name="header">
        <div class="header-box text-center mx-auto" style="color:#b71c1c; font-weight:700; font-size:1.4rem; padding: 10px 0;">
            {{ __('معلومات الحساب') }}
        </div>
    </x-slot>

    <style>
        /* إيقاف الوضع الليلي */
        body, .py-12 {
            background-color: #fff !important;
            color: #333 !important;
        }

        /* حقول الإدخال لتكون متناسقة */
        input[type="text"], input[type="email"], input[type="password"], input[type="tel"], textarea {
            width: 100%;
            padding: 10px 12px;
            margin-top: 6px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 6px;
            font-size: 1rem;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: #333;
            box-shadow: inset 0 1px 3px rgba(0,0,0,0.1);
            transition: border-color 0.3s ease;
            background-color: #fff;
        }

        input[type="text"]:focus, input[type="email"]:focus, input[type="password"]:focus, input[type="tel"]:focus, textarea:focus {
            outline: none;
            border-color: #b71c1c;
            box-shadow: 0 0 8px rgba(183,28,28,0.3);
            background-color: #fff;
        }

        label {
            font-weight: 600;
            color: #b71c1c;
            display: block;
            margin-top: 10px;
        }

        /* زر الحفظ */
        button[type="submit"] {
            background-color: #b71c1c;
            color: #fff;
            padding: 12px 25px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-weight: 700;
            font-size: 1.1rem;
            transition: background-color 0.3s ease;
            margin-top: 10px;
        }

        button[type="submit"]:hover {
            background-color: #7a0e0e;
        }
    </style>

    <div class="py-12" dir="rtl" style="background-image: url('/images/perfume-icons-bg.png'); background-size: contain; background-repeat: repeat; background-attachment: fixed;">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            {{-- تحديث معلومات الحساب --}}
            <div class="bg-white shadow rounded-lg p-6" style="background-color: rgba(255, 255, 255, 0.95); box-shadow: 0 12px 30px rgba(183, 28, 28, 0.15); border-radius: 15px;">
                <div class="max-w-xl mx-auto">
                    <form method="POST" action="{{ route('profile.update') }}">
                        @csrf
                        @method('PATCH')

                        <!-- الاسم -->
                        <label for="name">الاسم</label>
                        <input id="name" name="name" type="text" value="{{ old('name', auth()->user()->name) }}" required autofocus />

                        <!-- البريد الإلكتروني -->
                        <label for="email">البريد الإلكتروني</label>
                        <input id="email" name="email" type="email" value="{{ old('email', auth()->user()->email) }}" required />

                        <!-- رقم الهاتف -->
                        <label for="phone">رقم الهاتف</label>
                        <input id="phone" name="phone" type="tel" value="{{ old('phone', auth()->user()->phone ?? '') }}" placeholder="مثال: 0591234567" />

                        <!-- العنوان -->
                        <label for="address">العنوان</label>
                        <textarea id="address" name="address" rows="3" placeholder="اكتب عنوانك هنا...">{{ old('address', auth()->user()->address ?? '') }}</textarea>

                        @if (session('status') === 'profile-updated')
                            <div style="color: green; margin-bottom: 10px;">تم تحديث معلومات الحساب بنجاح.</div>
                        @endif

                        <button type="submit">حفظ التغييرات</button>
                    </form>
                </div>
            </div>

            {{-- تغيير كلمة المرور --}}
            <div class="bg-white shadow rounded-lg p-6" style="background-color: rgba(255, 255, 255, 0.95); box-shadow: 0 12px 30px rgba(183, 28, 28, 0.15); border-radius: 15px;">
                <div class="max-w-xl mx-auto">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            {{-- حذف الحساب --}}
            <div class="bg-white shadow rounded-lg p-6" style="background-color: rgba(255, 255, 255, 0.95); box-shadow: 0 12px 30px rgba(183, 28, 28, 0.15); border-radius: 15px;">
                <div class="max-w-xl mx-auto">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
