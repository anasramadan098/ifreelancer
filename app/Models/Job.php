<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'bio',
        'categories',
        'skills',
        'faq',
        'english_level',
        'job_type',
        'freelancer_type',
        'project_length',
        'radio_price',
        'price_min',
        'price_max',
        'user_id',
    ];
}
