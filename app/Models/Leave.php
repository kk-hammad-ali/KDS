<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Leave extends Model
{

    use HasFactory;

    protected $fillable = ['user_id', 'start_date', 'end_date', 'leave_reason', 'status'];

    public function instructor()
    {
        return $this->belongsTo(Instructor::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}


