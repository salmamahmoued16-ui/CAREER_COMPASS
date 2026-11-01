<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    // Get all comments
    public function index()
    {
        return response()->json([
            'status' => true,
            'data' => Comment::latest()->get()
        ]);
    }

    // Store a new comment
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'post_id' => 'required|exists:posts,id',
            'comment' => 'required|string',
        ]);

        $comment = Comment::create($request->all());

        return response()->json([
            'status' => true,
            'message' => 'Comment created successfully',
            'data' => $comment,
        ]);
    }

    // Get a single comment
    public function show($id)
    {
        $comment = Comment::find($id);

        if (!$comment) {
            return response()->json([
                'status' => false,
                'message' => 'Comment not found',
            ], 404);
        }

        return response()->json([
            'status' => true,
            'data' => $comment,
        ]);
    }

    // Update a comment
    public function update(Request $request, $id)
    {
        $comment = Comment::find($id);

        if (!$comment) {
            return response()->json([
                'status' => false,
                'message' => 'Comment not found',
            ], 404);
        }

        $comment->update($request->all());

        return response()->json([
            'status' => true,
            'message' => 'Comment updated successfully',
            'data' => $comment,
        ]);
    }

    // Delete a comment
    public function destroy($id)
    {
        $comment = Comment::find($id);

        if (!$comment) {
            return response()->json([
                'status' => false,
                'message' => 'Comment not found',
            ], 404);
        }

        $comment->delete();

        return response()->json([
            'status' => true,
            'message' => 'Comment deleted successfully',
        ]);
    }
}
