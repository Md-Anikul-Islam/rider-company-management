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
        Schema::create('trip_histories', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('passenger_id')->nullable();
            $table->unsignedBigInteger('driver_id');
            $table->unsignedBigInteger('company_id')->nullable();
            $table->unsignedBigInteger('agent_id')->nullable();
            $table->string('origin_address');
            $table->string('destination_address');
            $table->string('total_distance')->nullable();
            $table->string('change_destination_address')->nullable();
            $table->string('pick_time')->nullable();
            $table->string('drop_time')->nullable();
            $table->string('passenger_name')->nullable();
            $table->string('passenger_phone')->nullable();
            $table->string('estimated_fare')->nullable();
            $table->string('calculated_fare');
            $table->tinyInteger('fare_received_status')->default(0);
            $table->enum('trip_status', ['start', 'end'])->default('start');
            $table->enum('trip_type', ['request_trip', 'manual_trip'])->default('request_trip');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trip_histories');
    }
};
