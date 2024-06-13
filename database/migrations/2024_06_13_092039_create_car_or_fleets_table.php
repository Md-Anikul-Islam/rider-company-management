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
        Schema::create('car_or_fleets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('car_type_id')->constrained('fleet_types')->onDelete('cascade');
            $table->string('car_image')->nullable();
            $table->string('plate_no');
            $table->string('car_name')->nullable();
            $table->string('car_model')->nullable();
            $table->string('car_make')->nullable();
            $table->string('year')->nullable();
            $table->string('car_color')->nullable();
            $table->string('car_base')->nullable();
            $table->string('passengers')->nullable();
            $table->string('car_bag')->nullable();
            $table->string('car_register_card')->nullable();
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('car_or_fleets');
    }
};
