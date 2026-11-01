<?php

namespace App\Http\Controllers;

use App\Models\SalaryPrediction;
use Illuminate\Http\Request;

class SalaryPredictionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
   public function index($careerId)
{
    $salary = \App\Models\Career::find($careerId);

    if (!$salary) {
        return response()->json([
            'status' => false,
            'message' => 'Career not found'
        ], 404);
    }

    return response()->json([
        'status' => true,
        'career' => $salary->career_name,
        'salary' => $salary->expected_salary,
        'currency' => $salary->currency
    ]);
}

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(SalaryPrediction $salaryPrediction)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SalaryPrediction $salaryPrediction)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SalaryPrediction $salaryPrediction)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SalaryPrediction $salaryPrediction)
    {
        //
    }
}
