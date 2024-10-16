<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $fillable = [
        'car_id',
        'duration_days',
        'duration_minutes',
        'fees',
    ];


    public function car()
    {
        return $this->belongsTo(Car::class);
    }


    use HasFactory;
}
