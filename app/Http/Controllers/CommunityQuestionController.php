<?php

namespace App\Http\Controllers;

use App\Models\CommunityQuestion;
use Illuminate\Http\Request;

class CommunityQuestionController extends Controller
{
  public function index()
{
    $questions = CommunityQuestion::with(['user', 'answers.user'])->latest()->get();

    return response()->json(
        $questions->map(function ($question) {
            return [
                'id' => $question->id,
                'title' => $question->title,
                'question' => $question->question,

                'user' => [
                    'id' => $question->user->id,
                    'name' => $question->user->name,
                ],

                'answers' => $question->answers->map(function ($answer) {
                    return [
                        'id' => $answer->id,
                        'answer' => $answer->answer,

                        'user' => [
                            'id' => $answer->user->id,
                            'name' => $answer->user->name,
                        ],
                    ];
                }),
            ];
        })
    );
}

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'title' => 'required|string|max:255',
            'question' => 'required|string',
        ]);

        $question = CommunityQuestion::create($request->all());

        return response()->json([
            'status' => true,
            'message' => 'Question created successfully',
            'data' => $question,
        ]);
    }

    public function show($id)
    {
        return CommunityQuestion::with(['user', 'answers.user'])->findOrFail($id);
    }

    public function destroy($id)
    {
        CommunityQuestion::findOrFail($id)->delete();

        return response()->json([
            'status' => true,
            'message' => 'Deleted successfully',
        ]);
    }
}