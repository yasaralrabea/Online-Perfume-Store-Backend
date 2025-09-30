<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>معلومات المستلم</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f7f7f7;
            margin: 40px;
            color: #333;
            direction: rtl;
        }

        .container {
            max-width: 600px;
            margin: auto;
            background-color: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            text-align: center;
        }

        h2 {
            color: #2c3e50;
            margin-bottom: 20px;
        }

        .user-info {
            font-size: 18px;
            margin-bottom: 30px;
        }

        .confirm-btn {
            background-color: #b71c1c;
            color: white;
            border: none;
            padding: 12px 24px;
            border-radius: 6px;
            cursor: pointer;
            font-size: 16px;
        }

        .confirm-btn:hover {
            background-color: #a51414;
        }
    </style>
</head>
<body>

@if(session('success'))
<div class="success-message">
  {{ session('success') }}
</div>
@endif
    <div class="container">
        <h2>معلومات المستلم</h2>

        <div class="user-info">
            <p><strong>الاسم:</strong> {{ $user->name }}</p>
            <p><strong>البريد الإلكتروني:</strong> {{ $user->email }}</p>
            <p><strong> الهاتف:</strong> {{ $user->phone }}</p>
            <p><strong>العنوان :</strong> {{ $user->address }}</p>

        </div>

        <form action="{{ route('confirm.info') }}" method="POST">
            @csrf
            <input type="hidden" name="name" value="{{ $user->name }}">
            <input type="hidden" name="email" value="{{ $user->email }}">
            <input type="hidden" name="phone" value="{{ $user->phone }}">
            <input type="hidden" name="address" value="{{ $user->address }}">

            <button type="submit" class="confirm-btn">تأكيد</button>
        </form>
    </div>

</body>
</html>
