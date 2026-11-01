<?php

namespace App\Http\Controllers;

use App\Models\Assessment;

class HomeController extends Controller
{


public function index()
{
    $prediction = \App\Models\CareerPrediction::with('career.roadmaps')
        ->whereNotNull('career_id')
        ->latest()
        ->first();

    if (!$prediction) {
        return response()->json([
            'status' => false,
            'message' => 'No prediction found'
        ], 404);
    }

    return response()->json([
        'status' => true,

        'user' => [
            'name' => 'User',
            'career' => $prediction->predicted_career,
            'progress' => $prediction->confidence_score
        ],

        'career' => [
            'title' => $prediction->career->career_name,
            'salary' => $prediction->career->expected_salary,
            'currency' => $prediction->career->currency,
        ],

        'roadmap' => $prediction->career->roadmaps,

        'prediction' => [
            'career' => $prediction->predicted_career,
            'confidence_score' => $prediction->confidence_score,
        ]
    ]);
}












}
