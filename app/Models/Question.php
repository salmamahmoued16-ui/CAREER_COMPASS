<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $fillable = [
        'question',
        'question_order',
    ];

    public function options()
    {
        return $this->hasMany(Option::class);
    }
}
