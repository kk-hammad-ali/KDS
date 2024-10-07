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
            $table->foreignId('schedule_id')->constrained('schedules')->onDelete('cascade');
            $table->string('receipt_number')->unique();
            $table->date('invoice_date');
            $table->string('paid_by')->nullable();
            $table->string('amount_in_english')->nullable();
            $table->decimal('balance', 8, 2)->nullable();
            $table->string('branch')->nullable();
            $table->decimal('amount_received', 8, 2);
            $table->timestamps();
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
