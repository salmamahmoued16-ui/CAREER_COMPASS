<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
  use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
  protected $fillable = [
    'name',
    'email',
    'password',
    'otp',
    'otp_expires_at',
];
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
protected $hidden = [
    'password',
    'remember_token',
    'otp',
    'otp_expires_at',
];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */


protected function casts(): array
{
    return [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'otp_expires_at' => 'datetime',
    ];
}



// A user has many likes
public function likes()
{
    return $this->hasMany(Like::class);
}

// User has many saved posts
public function savedPosts()
{
    return $this->hasMany(SavedPost::class);
}


// User has many notifications
public function notifications()
{
    return $this->hasMany(Notification::class);
}


public function communityQuestions()
{
    return $this->hasMany(CommunityQuestion::class);
}

public function communityAnswers()
{
    return $this->hasMany(CommunityAnswer::class);
}










}
