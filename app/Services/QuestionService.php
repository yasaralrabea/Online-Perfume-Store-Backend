<?php

namespace App\Services;

use App\Repositories\QuestionRepository;
use Illuminate\Support\Facades\Auth;

class QuestionService
{
    protected $questionRepo;

    public function __construct(QuestionRepository $questionRepo)
    {
        $this->questionRepo = $questionRepo;
    }

    public function myQuestions()
    {
        $userId = Auth::user()->id;
        return $this->questionRepo->getAnswersByUser($userId);
    }

    public function sendQuestion(array $data)
    {
        $data['user_id'] = Auth::user()->id;
        return $this->questionRepo->createQuestion($data);
    }

    public function allQuestions()
    {
        return $this->questionRepo->getAllQuestions(true);
    }

    public function storeAnswer(array $data)
    {
        $question = $this->questionRepo->getQuestionById($data['question_id']);

        $this->questionRepo->createAnswer([
            'answer' => $data['answer'],
            'message' => $data['message'],
            'user_id' => $data['user_id'],
            'subject' => $data['subject'],
        ]);

        $question->condition = 'done';
        $question->save();

        return $question;
    }
}
