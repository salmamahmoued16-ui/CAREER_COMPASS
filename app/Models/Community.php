<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Community extends Model
{
    protected $fillable = [
        'title',
        'description',
    ];



// A community has many posts
public function posts()
{
    return $this->hasMany(Post::class);
}




}

