<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->increments('employee_id');
            $table->string('first_name', 20)->nullable();
            $table->string('last_name', 25);
            $table->string('email', 100);
            $table->string('phone_number', 20)->nullable();
            $table->date('hire_date');
            $table->unsignedInteger('job_id')->nullable();
            $table->decimal('salary', 8, 2);
            $table->unsignedInteger('manager_id')->nullable();
            $table->unsignedInteger('department_id')->nullable();

            $table->foreign('job_id')->references('job_id')->on('jobs');
            $table->foreign('manager_id')->references('employee_id')->on('employees');
            $table->foreign('department_id')->references('department_id')->on('departments');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
