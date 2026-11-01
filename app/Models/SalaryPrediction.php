<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SalaryPrediction extends Model
{
    protected $fillable = [
        'career_prediction_id',
        'expected_salary',
        'currency',
    ];

    public function careerPrediction()
    {
        return $this->belongsTo(CareerPrediction::class);
    }
}