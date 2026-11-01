<?php

namespace App\Http\Controllers;

use App\Models\Schedule;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    public function index(Request $request)
    {
        $schedules = Schedule::where(
            'user_id',
            $request->user()->id
        )
        ->orderBy('scheduled_date')
        ->get();

        return response()->json([
            'status' => true,
            'count' => $schedules->count(),
            'data' => $schedules,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'scheduled_date' => 'required|date',
            'type' => 'nullable|string|max:100',
            'completed' => 'nullable|boolean',
        ]);

        $schedule = Schedule::create([
            'user_id' => $request->user()->id,
            'title' => $request->title,
            'description' => $request->description,
            'scheduled_date' => $request->scheduled_date,
            'type' => $request->type,
            'completed' => $request->completed ?? false,
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Schedule created successfully',
            'data' => $schedule,
        ], 201);
    }

    public function update(Request $request, $id)
    {
        $schedule = Schedule::where('user_id', $request->user()->id)
            ->findOrFail($id);

        $request->validate([
            'title' => 'sometimes|string|max:255',
            'description' => 'nullable|string',
            'scheduled_date' => 'sometimes|date',
            'type' => 'nullable|string|max:100',
            'completed' => 'sometimes|boolean',
        ]);

        $schedule->update($request->only([
            'title',
            'description',
            'scheduled_date',
            'type',
            'completed',
        ]));

        return response()->json([
            'status' => true,
            'message' => 'Schedule updated successfully',
            'data' => $schedule,
        ]);
    }

    public function destroy(Request $request, $id)
    {
        $schedule = Schedule::where('user_id', $request->user()->id)
            ->findOrFail($id);

        $schedule->delete();

        return response()->json([
            'status' => true,
            'message' => 'Schedule deleted successfully',
        ]);
    }
}
