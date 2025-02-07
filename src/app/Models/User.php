<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail as MustVerifyEmailContract;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
// use Illuminate\Auth\MustVerifyEmail;


class User extends Authenticatable implements MustVerifyEmailContract 
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'about',
        'profile_pic',
        'user_type',
        'resume',
        'user_trial',
        'billings_ends',
        'status',
        'plan',
    ];

    public function listings()
    {
        return $this->belongsToMany(Listing::class, 'listing_user', 'user_id', 'listing_id')
        ->withPivot('shortlisted')
        ->withTimestamps();
    }

    public function jobs()
    {
        return $this->hasMany(Listing::class, 'user_id', 'id');
    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
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
        ];
    }
}
