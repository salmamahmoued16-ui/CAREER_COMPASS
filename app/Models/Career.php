<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Career extends Model
{
    protected $fillable = [
        'career_name',
        'expected_salary',
        'currency',
    ];

    public function roadmaps()
    {
        return $this->hasMany(Roadmap::class);
    }

    public function salaryPredictions()
    {
        return $this->hasMany(SalaryPrediction::class);
    }

    public function careerPredictions()
    {
        return $this->hasMany(CareerPrediction::class);
    }
}
