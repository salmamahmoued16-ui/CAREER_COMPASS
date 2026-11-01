<?php

namespace App\Http\Controllers;

class AppInfoController extends Controller
{
    public function index()
    {
        return response()->json([
            'status' => true,
            'data' => [
                'app_name' => 'Career Compass',
                'version' => '1.0.0',
                'description' => 'Career Compass helps students discover suitable career paths and build personalized learning roadmaps.',
                'support_email' => 'support@careercompass.com',
            ],
        ]);
    }
}
