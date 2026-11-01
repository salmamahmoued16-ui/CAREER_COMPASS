<?php

namespace App\Http\Controllers;

use App\Models\Like;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    // Get all likes
    public function index()
    {
        return response()->json([
            'status' => true,
            'data' => Like::latest()->get()
        ]);
    }

    // Store a new like
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'post_id' => 'required|exists:posts,id',
        ]);

        $like = Like::firstOrCreate([
            'user_id' => $request->user_id,
            'post_id' => $request->post_id,
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Post liked successfully',
            'data' => $like,
        ]);
    }

    // Get a single like
    public function show($id)
    {
        $like = Like::find($id);

        if (!$like) {
            return response()->json([
                'status' => false,
                'message' => 'Like not found',
            ], 404);
        }

        return response()->json([
            'status' => true,
            'data' => $like,
        ]);
    }

    // Update a like
    public function update(Request $request, $id)
    {
        $like = Like::find($id);

        if (!$like) {
            return response()->json([
                'status' => false,
                'message' => 'Like not found',
            ], 404);
        }

        $like->update($request->all());

        return response()->json([
            'status' => true,
            'message' => 'Like updated successfully',
            'data' => $like,
        ]);
    }

    // Delete a like
    public function destroy($id)
    {
        $like = Like::find($id);

        if (!$like) {
            return response()->json([
                'status' => false,
                'message' => 'Like not found',
            ], 404);
        }

        $like->delete();

        return response()->json([
            'status' => true,
            'message' => 'Like removed successfully',
        ]);
    }
}
