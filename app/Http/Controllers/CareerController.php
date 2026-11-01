<?php

namespace App\Http\Controllers;

use App\Models\Career;
use Illuminate\Http\Request;

class CareerController extends Controller
{
    // عرض كل الـ Careers
    public function index()
    {
        $careers = Career::all();

        return response()->json([
            'status' => true,
            'count' => $careers->count(),
            'data' => $careers
        ]);
    }

    // إضافة Career جديدة
    public function store(Request $request)
    {
        $request->validate([
            'career_name' => 'required|string|max:255|unique:careers,career_name',
            'expected_salary' => 'required|numeric',
            'currency' => 'required|string|max:10',
        ]);

        $career = Career::create([
            'career_name' => $request->career_name,
            'expected_salary' => $request->expected_salary,
            'currency' => $request->currency,
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Career created successfully',
            'data' => $career
        ], 201);
    }

    // عرض Career واحدة
    public function show($id)
    {
        $career = Career::find($id);

        if (!$career) {
            return response()->json([
                'status' => false,
                'message' => 'Career not found'
            ], 404);
        }

        return response()->json([
            'status' => true,
            'data' => $career
        ]);
    }

    // تعديل Career
    public function update(Request $request, $id)
    {
        $career = Career::find($id);

        if (!$career) {
            return response()->json([
                'status' => false,
                'message' => 'Career not found'
            ], 404);
        }

        $request->validate([
            'career_name' => 'required|string|max:255|unique:careers,career_name,' . $id,
            'expected_salary' => 'required|numeric',
            'currency' => 'required|string|max:10',
        ]);

        $career->update([
            'career_name' => $request->career_name,
            'expected_salary' => $request->expected_salary,
            'currency' => $request->currency,
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Career updated successfully',
            'data' => $career
        ]);
    }

    // حذف Career
    public function destroy($id)
    {
        $career = Career::find($id);

        if (!$career) {
            return response()->json([
                'status' => false,
                'message' => 'Career not found'
            ], 404);
        }

        $career->delete();

        return response()->json([
            'status' => true,
            'message' => 'Career deleted successfully'
        ]);
    }
}
