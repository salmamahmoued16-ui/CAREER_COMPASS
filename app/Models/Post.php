<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'user_id',
        'community_id',
        'title',
        'content',
        'image',
    ];

    // A post belongs to a user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // A post belongs to a community
    public function community()
    {
        return $this->belongsTo(Community::class);
    }

// A post has many likes
public function likes()
{
    return $this->hasMany(Like::class);
}


// Post has many saved posts
public function savedPosts()
{
    return $this->hasMany(SavedPost::class);
}




}