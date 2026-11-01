<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CommunityQuestion extends Model
{
    protected $fillable = [
        'user_id',
        'title',
        'question',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function answers()
    {
        return $this->hasMany(CommunityAnswer::class);
    }
}
