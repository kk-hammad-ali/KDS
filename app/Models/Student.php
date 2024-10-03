<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Instructor;
use App\Models\Course;
use App\Models\Car;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'father_or_husband_name',
        'cnic',
        'address',
        'phone',
        'optional_phone',
        'admission_date',
        'driving_time_per_week',
        'fees',
        'practical_driving_hours',
        'theory_classes',
        'coupon_code',
        'course_id',
        'instructor_id',
        'vehicle_id',
        'course_duration',
        'class_start_time',
        'class_end_time',
        'class_duration',
        'course_end_date',
        'form_type'
    ];

    // Define relationship with User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Define relationship with Instructor
    public function instructor()
    {
        return $this->belongsTo(Instructor::class);
    }

    // Define relationship with Course
    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    // Define relationship with Vehicle (Car)
    public function vehicle()
    {
        return $this->belongsTo(Car::class);
    }

    // Define relationship with Schedule
    public function schedules()
    {
        return $this->hasMany(Schedule::class);
    }

    public function attendances()
    {
        return $this->hasMany(Attendance::class, 'student_id');
    }

    public function invoices()
    {
        return $this->hasMany(Invoice::class);
    }
}
