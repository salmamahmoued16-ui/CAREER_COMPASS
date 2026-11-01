<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CommunityAnswer extends Model
{
    protected $fillable = [
        'community_question_id',
        'user_id',
        'answer',
    ];

    public function question()
    {
        return $this->belongsTo(CommunityQuestion::class, 'community_question_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
