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
        Schema::create('drivers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('car_id')->nullable()->constrained('car_or_fleets')->onDelete('cascade');
            $table->string('name');
            $table->string('email')->unique()->nullable();
            $table->string('phone')->unique();
            $table->string('password');
            $table->string('gender')->nullable();
            $table->date('dob')->nullable();
            $table->string('address')->nullable();
            $table->string('profile')->nullable();
            $table->string('driving_licence_font_image')->nullable();
            $table->string('driving_licence_back_image')->nullable();
            $table->string('rta_card_font_image')->nullable();
            $table->string('rta_card_back_image')->nullable();
            $table->float('ratting')->default(0);
            $table->enum('status', ['active','inactive','suspend'])->default('inactive');
            $table->text('device_information')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('drivers');
    }
};
