<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    // Get all notifications
    public function index()
    {
        return response()->json([
            'status' => true,
            'data' => Notification::latest()->get()
        ]);
    }

    // Create a new notification
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'title' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        $notification = Notification::create([
            'user_id' => $request->user_id,
            'title' => $request->title,
            'message' => $request->message,
            'is_read' => false,
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Notification created successfully',
            'data' => $notification,
        ]);
    }

    // Get a single notification
    public function show($id)
    {
        $notification = Notification::find($id);

        if (!$notification) {
            return response()->json([
                'status' => false,
                'message' => 'Notification not found',
            ], 404);
        }

        return response()->json([
            'status' => true,
            'data' => $notification,
        ]);
    }

    // Mark notification as read
    public function update(Request $request, $id)
    {
        $notification = Notification::find($id);

        if (!$notification) {
            return response()->json([
                'status' => false,
                'message' => 'Notification not found',
            ], 404);
        }

        $notification->update([
            'is_read' => true,
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Notification marked as read',
            'data' => $notification,
        ]);
    }

    // Delete notification
    public function destroy($id)
    {
        $notification = Notification::find($id);

        if (!$notification) {
            return response()->json([
                'status' => false,
                'message' => 'Notification not found',
            ], 404);
        }

        $notification->delete();

        return response()->json([
            'status' => true,
            'message' => 'Notification deleted successfully',
        ]);
    }
}
