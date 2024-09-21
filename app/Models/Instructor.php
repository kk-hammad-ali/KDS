<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Instructor extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'id_card_number',
        'license_city',
        'license_start_date',
        'license_end_date',
        'experience',
        'phone_number',
        'address',
        'picture',
        'gender',
        'license_number',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function students()
    {
        return $this->hasMany(Student::class);
    }

    public function schedules()
    {
        return $this->hasMany(Schedule::class);
    }

    public function attendances()
    {
        return $this->hasMany(Attendance::class, 'instructor_id');
    }
}
