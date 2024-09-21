<?php

namespace App\Models;

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'instructor_id',
        'attendance_date',
        'student_present',
        'instructor_present'
    ];

    // Define the relationship to the Student model
    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id');
    }

    // Define the relationship to the Instructor model
    public function instructor()
    {
        return $this->belongsTo(Instructor::class, 'instructor_id');
    }
}

