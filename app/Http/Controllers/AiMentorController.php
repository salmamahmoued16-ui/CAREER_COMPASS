<?php

namespace App\Http\Controllers;

use App\Models\AiMessage;
use Illuminate\Http\Request;

class AiMentorController extends Controller
{
    public function chat(Request $request)
    {
        $request->validate([
            'message' => 'required|string|max:2000',
        ]);

        $user = $request->user();

        $message = strtolower($request->message);

        if (str_contains($message, 'laravel')) {
            $response = 'Laravel is a PHP framework. Start with routing, controllers, models, migrations, and Eloquent.';
        } elseif (str_contains($message, 'php')) {
            $response = 'To learn PHP, start with variables, conditions, loops, functions, OOP, and then move to Laravel.';
        } elseif (str_contains($message, 'backend')) {
            $response = 'For backend development, focus on PHP, Laravel, databases, REST APIs, authentication, and Git.';
        } elseif (str_contains($message, 'career')) {
            $response = 'Choose a career based on your interests and skills, then build a roadmap with courses and practical projects.';
        } elseif (str_contains($message, 'flutter')) {
            $response = 'Flutter can communicate with your Laravel backend through REST APIs using HTTP requests.';
        } else {
            $response = 'I am your AI Mentor. Tell me about your career, programming, courses, or skills and I will help you.';
        }

        $aiMessage = AiMessage::create([
            'user_id' => $user->id,
            'message' => $request->message,
            'response' => $response,
        ]);

        return response()->json([
            'status' => true,
            'data' => $aiMessage,
        ]);
    }

    public function history(Request $request)
    {
        $messages = AiMessage::where('user_id', $request->user()->id)
            ->latest()
            ->get();

        return response()->json([
            'status' => true,
            'data' => $messages,
        ]);
    }
}
