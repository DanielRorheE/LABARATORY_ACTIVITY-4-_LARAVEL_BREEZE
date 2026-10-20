<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('countries', function (Blueprint $table) {
            $table->char('country_id', 2)->primary();
            $table->string('country_name', 40)->nullable();
            $table->unsignedInteger('region_id');

            $table->foreign('region_id')->references('region_id')->on('regions');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('countries');
    }
};
