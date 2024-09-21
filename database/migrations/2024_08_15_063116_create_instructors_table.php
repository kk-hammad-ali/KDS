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
        Schema::create('instructors', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('id_card_number');
            $table->string('license_city');
            $table->date('license_start_date');
            $table->date('license_end_date');
            $table->string('experience')->nullable();
            $table->string('phone_number')->unique();
            $table->string('address')->nullable();
            $table->string('picture')->nullable();
            $table->enum('gender', ['male', 'female']);
            $table->string('license_number');
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
        Schema::dropIfExists('instructors');
    }
};
