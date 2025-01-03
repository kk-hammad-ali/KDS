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
            $table->foreignId('branch_id')->nullable()->constrained('branches')->onDelete('cascade');
            $table->string('father_or_husband_name')->nullable();
            $table->string('cnic')->unique()->nullable();
            $table->string('address');
            $table->string('phone');
            $table->string('optional_phone')->nullable();
            $table->date('admission_date');
            $table->string('email')->nullable();
            $table->decimal('fees', 8, 2);
            $table->integer('practical_driving_hours');
            $table->integer('theory_classes');
            $table->string('coupon_code')->nullable();
            $table->foreignId('course_id')->constrained('courses')->onDelete('cascade');
            $table->foreignId('instructor_id')->nullable()->constrained('instructors')->onDelete('cascade');
            $table->integer('course_duration');
            $table->time('class_start_time')->nullable();
            $table->time('class_end_time')->nullable();
            $table->integer('class_duration')->nullable();
            $table->date('course_end_date')->nullable();
            $table->enum('form_type', ['admin', 'admission']);
            $table->string('pickup_sector')->nullable();
            $table->text('timing_preference')->nullable();
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
