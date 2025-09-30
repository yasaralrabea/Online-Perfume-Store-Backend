<?php

namespace App\Repositories;

use App\Models\Question;
use App\Models\Answer;

class QuestionRepository
{
    public function getAllQuestions($withTrashed = false)
    {
        return $withTrashed ? Question::withTrashed()->get() : Question::all();
    }

    public function getQuestionById($id)
    {
        return Question::withTrashed()->findOrFail($id);
    }

    public function createQuestion(array $data)
    {
        return Question::create($data);
    }

    public function updateQuestion(Question $question, array $data)
    {
        $question->update($data);
        return $question;
    }

    public function getAnswersByUser($userId)
    {
        return Answer::where('user_id', $userId)->get();
    }

    public function createAnswer(array $data)
    {
        return Answer::create($data);
    }
}
