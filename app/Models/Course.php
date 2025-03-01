<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $fillable = [
        'car_model_id',
        'duration_days',
        'duration_minutes',
        'fees',
        'course_type', // New column
        'discount', // Added discount column
    ];

    /**
     * Get the car model associated with the course.
     */
    public function carModel()
    {
        return $this->belongsTo(CarModel::class);
    }

    /**
     * Get the students enrolled in the course.
     */
    public function students()
    {
        return $this->hasMany(Student::class);
    }

    /**
     * Get the final price after applying the discount.
     *
     * @return float
     */
    public function finalPrice()
    {
        if ($this->discount) {
            return $this->fees - ($this->fees * ($this->discount / 100));
        }

        return $this->fees;
    }
}
