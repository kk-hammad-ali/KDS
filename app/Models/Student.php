<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Instructor;
use App\Models\Course;
use App\Models\Branch;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'branch_id',
        'father_or_husband_name',
        'cnic',
        'address',
        'phone',
        'optional_phone',
        'admission_date',
        'email',
        'coupon_code',
        'course_id',
        'instructor_id',
        'course_duration',
        'form_type',
        'pickup_sector',
        'timing_preference',
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

    // Define relationship with Branch
    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }

    // Define relationship with Attendance
    public function attendances()
    {
        return $this->hasMany(Attendance::class, 'student_id');
    }


    // Define relationship with Schedule
    public function schedules()
    {
        return $this->hasMany(Schedule::class);
    }

    // In Student.php model
    public function invoice()
    {
        return $this->hasOneThrough(
            Invoice::class,
            Schedule::class,
            'student_id', // Foreign key on the schedules table
            'schedule_id', // Foreign key on the invoices table
            'id', // Local key on the students table
            'id' // Local key on the schedules table
        );
    }

    // Removed unnecessary relationships:
    // - Schedules: Not explicitly defined in the migration
    // - Invoice via Schedules: No schedule or invoice relationships provided in the migration
}
