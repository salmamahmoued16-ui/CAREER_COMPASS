<?php

namespace App\Http\Controllers;

use App\Models\CareerPath;
use Illuminate\Http\Request;

class CareerPathController extends Controller
{
    public function index()
    {
        $careerPaths = CareerPath::all();

        return response()->json([
            'status' => true,
            'count' => $careerPaths->count(),
            'data' => $careerPaths
        ]);
    }

    public function show($id)
    {
        $career = CareerPath::find($id);

        if (!$career) {
            return response()->json([
                'status' => false,
                'message' => 'Career Path not found'
            ], 404);
        }

        return response()->json([
            'status' => true,
            'data' => $career
        ]);
    }
}