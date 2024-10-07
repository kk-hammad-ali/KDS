<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    protected $table = 'invoices';

    protected $fillable = [
        'schedule_id',
        'receipt_number',
        'invoice_date',
        'paid_by',
        'amount_in_english',
        'balance',
        'branch',
        'amount_received',

    ];

    // /**
    //  * Relationship to the Student model
    //  */
    // public function student()
    // {
    //     return $this->belongsTo(Student::class);
    // }

    // /**
    //  * Relationship to the Instructor model
    //  */
    // public function instructor()
    // {
    //     return $this->belongsTo(Instructor::class);
    // }

    // /**
    //  * Relationship to the Schedule model
    //  */
    public function schedule()
    {
        return $this->belongsTo(Schedule::class);
    }
}
