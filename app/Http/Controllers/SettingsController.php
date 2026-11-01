<?php

namespace App\Http\Controllers;

use App\Models\UserSetting;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function show(Request $request)
    {
        $settings = UserSetting::firstOrCreate(
            ['user_id' => $request->user()->id],
            [
                'dark_mode' => false,
                'notifications_enabled' => true,
                'language' => 'English',
                'profile_public' => true,
                'show_activity' => true,
            ]
        );

        return response()->json([
            'status' => true,
            'data' => $settings,
        ]);
    }

    public function update(Request $request)
    {
        $request->validate([
            'dark_mode' => 'sometimes|boolean',
            'notifications_enabled' => 'sometimes|boolean',
            'language' => 'sometimes|string|in:English,Arabic',
            'profile_public' => 'sometimes|boolean',
            'show_activity' => 'sometimes|boolean',
        ]);

        $settings = UserSetting::firstOrCreate(
            ['user_id' => $request->user()->id]
        );

        $settings->update($request->only([
            'dark_mode',
            'notifications_enabled',
            'language',
            'profile_public',
            'show_activity',
        ]));

        return response()->json([
            'status' => true,
            'message' => 'Settings updated successfully',
            'data' => $settings,
        ]);
    }
}
