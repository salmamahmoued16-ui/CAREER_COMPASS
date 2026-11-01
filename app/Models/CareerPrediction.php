<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CareerPrediction extends Model
{
    protected $fillable = [
        'assessment_id',
        'career_id',
        'predicted_career',
        'confidence_score',
    ];

    public function assessment()
    {
        return $this->belongsTo(Assessment::class);
    }

    public function career()
    {
        return $this->belongsTo(Career::class);
    }
}