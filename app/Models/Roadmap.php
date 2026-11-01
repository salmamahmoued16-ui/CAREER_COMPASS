<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Roadmap extends Model
{
    protected $fillable = [
        'career_id',
        'step_number',
        'course_name',
        'description',
    ];

    public function career()
    {
        return $this->belongsTo(Career::class);
    }
}