<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserSetting extends Model
{
    protected $fillable = [
        'user_id',
        'dark_mode',
        'notifications_enabled',
        'language',
        'profile_public',
        'show_activity',
    ];

    protected $casts = [
        'dark_mode' => 'boolean',
        'notifications_enabled' => 'boolean',
        'profile_public' => 'boolean',
        'show_activity' => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}