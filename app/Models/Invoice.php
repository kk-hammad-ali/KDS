<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    protected $table = 'invoices';

    protected $fillable = [
        'student_id',
        'instructor_id',
        'schedule_id',
        'invoice_date',
        'balance',
        'receipt_number',
        'amount_received',
        'advance_against',
        'class_timing',
        'days',
        'branch',
        'receiver_signature',
    ];

    /**
     * Relationship to the Student model
     */
    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    /**
     * Relationship to the Instructor model
     */
    public function instructor()
    {
        return $this->belongsTo(Instructor::class);
    }

    /**
     * Relationship to the Schedule model
     */
    public function schedule()
    {
        return $this->belongsTo(Schedule::class);
    }
}
