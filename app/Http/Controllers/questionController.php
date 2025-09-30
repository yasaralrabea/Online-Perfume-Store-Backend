<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\QuestionService;

class QuestionController extends Controller
{
    protected $questionService;

    public function __construct(QuestionService $questionService)
    {
        $this->questionService = $questionService;
    }

    public function my_q()
    {
        $answers = $this->questionService->myQuestions();
        return view('my_q', compact('answers'));
    }

    public function send()
    {
        return view('send');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',   
            'subject' => 'required|string|max:255', 
            'message' => 'required|string',       
        ]);

        $this->questionService->sendQuestion($request->all());

        return redirect()->back()->with('success', 'تم إرسال السؤال بنجاح');
    }

    public function show()
    {
        $questions = $this->questionService->allQuestions();
        return view('show_Q', compact('questions'));
    }
public function store_A(Request $request)
{
    $request->validate([
        'question_id' => 'required|exists:questions,id',
        'answer' => 'required|string|max:1000',
        'message' => 'nullable|string|max:2000',
        'user_id' => 'required|exists:users,id',
        'subject' => 'required|string|max:255',
    ]);

    $this->questionService->storeAnswer($request->all());

    return view('sucss_Q', ['message' => 'تم إرسال الإجابة بنجاح']);
}

}
