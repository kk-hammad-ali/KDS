<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained('students')->onDelete('cascade'); // References students table
            $table->foreignId('instructor_id')->constrained('instructors')->onDelete('cascade'); // References instructors table
            $table->foreignId('schedule_id')->constrained('schedules')->onDelete('cascade'); // References schedules table
            $table->date('invoice_date');  // Date of the invoice
            $table->decimal('balance', 8, 2)->nullable();  // Remaining balance after payment
            $table->string('receipt_number')->unique();  // Unique receipt number
            $table->decimal('amount_received', 8, 2);  // Total amount received
            $table->string('advance_against')->nullable();  // Purpose of the advance (e.g., class fees)
            $table->string('class_timing')->nullable();  // Scheduled class timing
            $table->integer('days')->nullable();  // Duration in days
            $table->string('branch')->nullable();  // Branch where the invoice was issued
            $table->string('receiver_signature')->nullable();  // Receiver's signature
            $table->timestamps();  // Timestamps for created_at and updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoices');
    }
};
