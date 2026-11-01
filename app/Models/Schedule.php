<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    protected $fillable = [
        'user_id',
        'title',
        'description',
        'scheduled_date',
        'type',
        'completed',
    ];

    protected $casts = [
        'scheduled_date' => 'date',
        'completed' => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}