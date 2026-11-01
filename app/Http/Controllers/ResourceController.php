<?php

namespace App\Http\Controllers;

use App\Models\Resource;
use Illuminate\Http\Request;

class ResourceController extends Controller
{
    // Get all resources
    public function index()
    {
        return response()->json([
            'status' => true,
            'data' => Resource::all(),
        ]);
    }

    // Create resource
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'type' => 'required|string',
            'link' => 'required|string',
            'image' => 'nullable|string',
        ]);

        $resource = Resource::create($request->all());

        return response()->json([
            'status' => true,
            'message' => 'Resource created successfully',
            'data' => $resource,
        ]);
    }

    // Show one resource
    public function show($id)
    {
        return response()->json([
            'status' => true,
            'data' => Resource::findOrFail($id),
        ]);
    }

    // Update resource
    public function update(Request $request, $id)
    {
        $resource = Resource::findOrFail($id);

        $resource->update($request->all());

        return response()->json([
            'status' => true,
            'message' => 'Resource updated successfully',
            'data' => $resource,
        ]);
    }

    // Delete resource
    public function destroy($id)
    {
        Resource::findOrFail($id)->delete();

        return response()->json([
            'status' => true,
            'message' => 'Resource deleted successfully',
        ]);
    }
}
