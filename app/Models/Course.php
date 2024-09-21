<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $fillable = [
        'duration_days',
        'duration_minutes',
        'fees',
    ];

    
    use HasFactory;
}
