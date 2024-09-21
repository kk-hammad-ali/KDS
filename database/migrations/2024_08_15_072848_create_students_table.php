<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('father_or_husband_name');
            $table->string('cnic')->unique();
            $table->string('address');
            $table->string('phone');
            $table->string('optional_phone')->nullable();
            $table->date('admission_date');
            $table->integer('driving_time_per_week');
            $table->decimal('fees', 8, 2);
            $table->integer('practical_driving_hours');
            $table->integer('theory_classes');
            $table->string('coupon_code')->nullable();
            $table->foreignId('course_id')->constrained('courses')->onDelete('cascade');
            $table->foreignId('instructor_id')->constrained('employees')->onDelete('cascade'); // Updated to reference employees
            $table->foreignId('vehicle_id')->constrained('cars')->onDelete('cascade');
            $table->integer('course_duration');
            $table->time('class_start_time');
            $table->time('class_end_time');
            $table->integer('class_duration');
            $table->date('course_end_date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('students');
    }
};
