<?php

namespace App\Http\Controllers;

use App\Models\SupportTicket;
use Illuminate\Http\Request;

class SupportController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        $ticket = SupportTicket::create([
            'user_id' => $request->user()->id,
            'subject' => $request->subject,
            'message' => $request->message,
            'status' => 'open',
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Support request submitted successfully',
            'data' => $ticket,
        ], 201);
    }

    public function index(Request $request)
    {
        $tickets = SupportTicket::where(
            'user_id',
            $request->user()->id
        )->latest()->get();

        return response()->json([
            'status' => true,
            'count' => $tickets->count(),
            'data' => $tickets,
        ]);
    }
}
