<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>إرسال استشارة</title>
    <link rel="stylesheet" href="{{ asset('css/send.css') }}">
    <style>
        .top-button {
            display: flex;
            justify-content: flex-end;
            margin-bottom: 15px;
        }
        .top-button a {
            background-color: #fa314a;
            color: #fff;
            text-decoration: none;
            padding: 8px 16px;
            border-radius: 8px;
            font-weight: 600;
            transition: all 0.3s ease;
        }
        .top-button a:hover {
            background-color: #d02538;
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

        <!-- زر استفساراتي أعلى الفورم -->
        <div class="top-button">
            <a href="{{ route('my_q') }}">استفساراتي</a>
        </div>

        <h2>إرسال استفسار</h2>

        <form action="{{ route('send.store') }}" method="POST">
            @csrf
            <label for="name">الاسم:</label>
            <input type="text" id="name" name="name" required placeholder="أدخل اسمك">

            <label for="subject">العنوان:</label>
            <input type="text" id="subject" name="subject" required placeholder="أدخل عنوان السؤال">

            <label for="message">نص السؤال:</label>
            <textarea id="message" name="message" rows="5" required placeholder="اكتب سؤالك هنا"></textarea>

            <button type="submit">إرسال السؤال</button>
        </form>
    </div>

</body>
</html>
