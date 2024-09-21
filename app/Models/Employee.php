<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'email',
        'phone',
        'id_card_number',
        'address',
        'salary',
        'salary_status',
        'employee_status',
        'gender',
        'designation',
        'picture',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
