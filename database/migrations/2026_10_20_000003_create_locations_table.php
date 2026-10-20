<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('locations', function (Blueprint $table) {
            $table->increments('location_id');
            $table->string('street_address', 40)->nullable();
            $table->string('postal_code', 12)->nullable();
            $table->string('city', 30);
            $table->string('state_province', 25)->nullable();
            $table->char('country_id', 2);

            $table->foreign('country_id')->references('country_id')->on('countries');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('locations');
    }
};
