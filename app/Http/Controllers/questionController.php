<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Question;
use App\Models\Answer;

use Illuminate\Support\Facades\Auth;


class questionController extends Controller
{
    public function my_q()
    {
        $user_id = Auth::user()->id;
        $answers = Answer::where('user_id', $user_id)->get();
        return view('my_q', compact('answers'));

    }
    public function send()
    {
        return view('send');
    }

    public function store(Request $request)
    {
        $user_id = Auth::user()->id;

        $request->validate([
            'name' => 'required|string|max:255',   
            'subject' => 'required|string|max:255', 
            'message' => 'required|string',       
        ]);
    
        Question::create([
            'name' => $request->name,
            'subject' => $request->subject,
            'message' => $request->message,
            'user_id' => $user_id,
        ]);
    
        return redirect()->back()->with('success', 'تم إرسال السؤال بنجاح');
    }
    

    public function show()
    {
        $questions = Question::withTrashed()->get();
        return view('show_Q', compact('questions'));

    }

    public function store_A(Request $request)
    {
     
        $question = Question::withTrashed()->findOrFail($request->question_id);    

        Answer::create([
            'answer' => $request->answer,
            'message' => $request->message,
            'user_id' => $request->user_id,   
            'subject' => $request->subject,

        ]);
        $question->condition='done';
        $question->save();

        return view('sucss_Q', ['message' => 'تم إرسال  الإجابة بنجاح']);
    }
}


