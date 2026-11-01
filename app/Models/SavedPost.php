<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SavedPost extends Model
{
    protected $fillable = [
        'user_id',
        'post_id',
    ];

    // Saved post belongs to a user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Saved post belongs to a post
    public function post()
    {
        return $this->belongsTo(Post::class);
    }
}
