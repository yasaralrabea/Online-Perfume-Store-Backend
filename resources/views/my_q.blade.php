<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>استفساراتي</title>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Cairo', sans-serif;
        }

        body {
            background: #f9fbfc;
            color: #333;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            direction: rtl;
            padding: 20px;
        }

        h2 {
            text-align: center;
            color: #fa314a;
            font-size: 28px;
            margin-bottom: 30px;
        }

        .answer-box {
            display: flex;
            flex-direction: column; /* الخانات تحت بعض */
            background: #ffffffcc;
            backdrop-filter: blur(6px);
            padding: 20px;
            margin: 15px auto;
            border-radius: 15px;
            box-shadow: 0 5px 12px rgba(0,0,0,0.1);
            max-width: 700px;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .answer-box:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.15);
        }

        .answer-box p {
            margin: 10px 0;
            line-height: 1.6;
            font-size: 16px;
            padding: 10px 15px;
            background: #f1f5f9;
            border-radius: 10px;
            box-shadow: inset 0 1px 3px rgba(0,0,0,0.05);
        }

        .answer-box strong {
            color: #fa314a;
            font-weight: 600;
        }

        .no-answers {
            text-align: center;
            color: #555;
            font-size: 20px;
            margin-top: 50px;
        }
    </style>
</head>
<body>

    <h2>استفساراتي</h2>

    @if($answers->isEmpty())
        <p class="no-answers">لا توجد أسئلة.</p>
    @else
        @foreach($answers as $answer)
            <div class="answer-box">
                <p><strong>الموضوع:</strong> {{ $answer->subject ?? 'غير متوفر' }}</p>
                <p><strong>السؤال:</strong> {{ $answer->message ?? 'غير متوفر' }}</p>
                <p><strong>اسم الطبيب المجيب:</strong> 
                    {{ $answer->answer ? $answer->doctor_name : 'لم تتم الإجابة بعد' }}
                </p>
                <p><strong>الجواب:</strong> 
                    {{ $answer->answer ?? 'لم تتم الإجابة بعد' }}
                </p>
            </div>
        @endforeach
    @endif

</body>
</html>
