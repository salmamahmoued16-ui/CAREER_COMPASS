<?php

namespace App\Http\Controllers;

use App\Models\Question;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    public function index()
    {
        $questions = Question::with('options')
            ->orderBy('question_order')
            ->get();

        return response()->json([
            'status' => true,
            'count' => $questions->count(),
            'data' => $questions
        ]);
    }
}
