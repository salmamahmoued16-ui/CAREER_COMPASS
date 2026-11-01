<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    // Get all posts
    public function index()
    {
        $posts = Post::with('user')
            ->latest()
            ->get();

        return response()->json([
            'status' => true,
            'data' => $posts
        ]);
    }

    // Store a new post
    public function store(Request $request)
    {
        $request->validate([
            'community_id' => 'required|exists:communities,id',
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'image' => 'nullable|string',
        ]);

        $post = Post::create([
            'user_id' => $request->user()->id,
            'community_id' => $request->community_id,
            'title' => $request->title,
            'content' => $request->content,
            'image' => $request->image,
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Post created successfully',
            'data' => $post->load('user'),
        ]);
    }

    // Get a single post
    public function show($id)
    {
        $post = Post::with('user')->find($id);

        if (!$post) {
            return response()->json([
                'status' => false,
                'message' => 'Post not found',
            ], 404);
        }

        return response()->json([
            'status' => true,
            'data' => $post,
        ]);
    }

    // Update a post
    public function update(Request $request, $id)
    {
        $post = Post::find($id);

        if (!$post) {
            return response()->json([
                'status' => false,
                'message' => 'Post not found',
            ], 404);
        }

        $post->update($request->only([
            'title',
            'content',
            'image',
            'community_id',
        ]));

        return response()->json([
            'status' => true,
            'message' => 'Post updated successfully',
            'data' => $post->load('user'),
        ]);
    }

    // Delete a post
    public function destroy($id)
    {
        $post = Post::find($id);

        if (!$post) {
            return response()->json([
                'status' => false,
                'message' => 'Post not found',
            ], 404);
        }

        $post->delete();

        return response()->json([
            'status' => true,
            'message' => 'Post deleted successfully',
        ]);
    }
}
