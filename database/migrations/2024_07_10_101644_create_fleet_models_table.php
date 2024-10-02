<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('fleet_models', function (Blueprint $table) {
            $table->id();
            $table->foreignId('fleet_make_id')->constrained('fleet_makes')->onDelete('cascade');
            $table->string('car_model_name');
            $table->string('car_base_fare');
            $table->string('car_passenger_capacity');
            $table->string('car_bag_capacity');
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fleet_models');
    }
};
