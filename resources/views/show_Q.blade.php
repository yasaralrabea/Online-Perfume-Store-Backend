<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>عرض الأسئلة</title>
    <link rel="stylesheet" href="{{ asset('css/show_Q.css') }}"> {{-- ربط ملف CSS --}}
</head>
<body>
    
@if(session('success'))
<div class="success-message">
  {{ session('success') }}
</div>
@endif

    <div class="container">
        <h2>الأسئلة المطروحة</h2>

        @foreach($questions as $question)
            <div class="question-box">
                <h3>{{ $question->subject }}</h3>
                <p><strong>الحالة:</strong> {{ $question->condition }}</p>
                <p><strong>السؤال:</strong> {{ $question->message }}</p>
                <p><strong>السائل:</strong> {{ $question->name }}</p>

                @if($question->condition !== 'done')
<form action="{{ route('answer.store') }}" method="POST">
    @csrf
    <input type="hidden" name="question_id" value="{{ $question->id }}">
    <input type="hidden" name="subject" value="{{ $question->subject }}">
    <input type="hidden" name="message" value="{{ $question->message }}">   
    <input type="hidden" name="user_id" value="{{ $question->user_id }}">

   
    <label for="answer">الرد:</label>
    <textarea name="answer" rows="3" required></textarea>

    <button type="submit">إرسال الرد</button>
</form>
@endif
            </div>
        @endforeach

    </div>

</body>
</html>
