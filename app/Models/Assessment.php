<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Assessment extends Model
{
    protected $fillable = [
        'age',
        'school_university',
        'study_year',
        'favorite_activity',
        'interested_fields',
        'current_need',
        'join_workshop',
        'commitment_level',
        'career_goal',
        'biggest_challenge',
        'career_awareness',
        'work_preference',

        'education',
        'specialization',
        'skills',
        'certification',
        'cgpa',
    ];

    protected $casts = [
        'join_workshop' => 'boolean',
        'career_awareness' => 'boolean',
        'skills' => 'array',
        'cgpa' => 'float',
    ];

    public function careerPredictions()
    {
        return $this->hasMany(CareerPrediction::class);
    }
}