<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('fixed_expenses', function (Blueprint $table) {
            $table->id();
            $table->string('expense_type'); // Rent, Salary, Utilities, etc.
            $table->decimal('amount', 10, 2);
            $table->foreignId('employee_id')->nullable()->constrained('employees')->onDelete('cascade'); // Optional for salary
            $table->date('expense_date');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('fixed_expenses');
    }
};
