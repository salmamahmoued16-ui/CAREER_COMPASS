<?php

namespace App\Http\Controllers;

use App\Models\Community;
use Illuminate\Http\Request;

class CommunityController extends Controller
{
    
    public function index()
    {
        return response()->json([
            'status' => true,
            'data' => Community::latest()->get()
        ]);
    }

   
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        $community = Community::create([
            'title' => $request->title,
            'description' => $request->description,
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Community created successfully',
            'data' => $community
        ]);
    }

    
    public function show($id)
    {
        $community = Community::find($id);

        if (!$community) {
            return response()->json([
                'status' => false,
                'message' => 'Community not found'
            ], 404);
        }

        return response()->json([
            'status' => true,
            'data' => $community
        ]);
    }

 
    public function update(Request $request, $id)
    {
        $community = Community::find($id);

        if (!$community) {
            return response()->json([
                'status' => false,
                'message' => 'Community not found'
            ], 404);
        }

        $community->update($request->all());

        return response()->json([
            'status' => true,
            'message' => 'Community updated successfully',
            'data' => $community
        ]);
    }

  
    public function destroy($id)
    {
        $community = Community::find($id);

        if (!$community) {
            return response()->json([
                'status' => false,
                'message' => 'Community not found'
            ], 404);
        }

        $community->delete();

        return response()->json([
            'status' => true,
            'message' => 'Community deleted successfully'
        ]);
    }
}
