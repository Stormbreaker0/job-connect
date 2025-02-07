<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Listing extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'description',
        'roles',
        'slug',
        'job_type',
        'address',
        'salary',
        'application_deadline',
        'feature_image'
    ];

    // Relationship with users
    public function users()
    {
        return $this->belongsToMany(User::class,'listing_user', 'listing_id', 'user_id')
        ->withPivot('shortlisted')
        ->withTimestamps();
    }

    public function profile()
    {
        return $this->belongsTo(User::class,'user_id','id');
    }

}
