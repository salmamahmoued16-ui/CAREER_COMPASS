<?php

namespace App\Http\Controllers;

use App\Models\SavedPost;
use Illuminate\Http\Request;

class SavedPostController extends Controller
{
    // Get all saved posts
    public function index()
    {
        return response()->json([
            'status' => true,
            'data' => SavedPost::latest()->get()
        ]);
    }

    // Save a post
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'post_id' => 'required|exists:posts,id',
        ]);

        $savedPost = SavedPost::firstOrCreate([
            'user_id' => $request->user_id,
            'post_id' => $request->post_id,
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Post saved successfully',
            'data' => $savedPost,
        ]);
    }

    // Get a single saved post
    public function show($id)
    {
        $savedPost = SavedPost::find($id);

        if (!$savedPost) {
            return response()->json([
                'status' => false,
                'message' => 'Saved post not found',
            ], 404);
        }

        return response()->json([
            'status' => true,
            'data' => $savedPost,
        ]);
    }

    // Update a saved post
    public function update(Request $request, $id)
    {
        $savedPost = SavedPost::find($id);

        if (!$savedPost) {
            return response()->json([
                'status' => false,
                'message' => 'Saved post not found',
            ], 404);
        }

        $savedPost->update($request->all());

        return response()->json([
            'status' => true,
            'message' => 'Saved post updated successfully',
            'data' => $savedPost,
        ]);
    }
}