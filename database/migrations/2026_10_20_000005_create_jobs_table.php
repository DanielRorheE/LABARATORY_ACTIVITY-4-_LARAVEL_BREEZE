<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('jobs', function (Blueprint $table) {
            $table->increments('job_id');
            $table->string('job_title', 35);
            $table->decimal('min_salary', 8, 2)->nullable();
            $table->decimal('max_salary', 8, 2)->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('jobs');
    }
};
