<?php

namespace App\Http\Controllers;

use App\Models\CommunityAnswer;
use Illuminate\Http\Request;

class CommunityAnswerController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'community_question_id' => 'required|exists:community_questions,id',
            'user_id' => 'required|exists:users,id',
            'answer' => 'required|string',
        ]);

        $answer = CommunityAnswer::create($request->all());

        return response()->json([
            'status' => true,
            'message' => 'Answer added successfully',
            'data' => $answer,
        ]);
    }

    public function destroy($id)
    {
        CommunityAnswer::findOrFail($id)->delete();

        return response()->json([
            'status' => true,
            'message' => 'Deleted successfully',
        ]);
    }
}
