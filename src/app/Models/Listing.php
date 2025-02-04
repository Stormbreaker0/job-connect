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
}
