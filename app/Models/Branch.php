<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'address'];

    public function users()
    {
        return $this->hasMany(User::class, 'current_branch_id');
    }

    public function employees()
    {
        return $this->hasMany(Employee::class);
    }

    public function students()
    {
        return $this->hasMany(Student::class);
    }
}
