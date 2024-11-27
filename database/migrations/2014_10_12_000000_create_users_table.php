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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('complete_name');
            $table->string('purok');
            $table->string('sex');
            $table->string('bday');
            $table->string('civil_status');
            $table->string('place_of_birth');
            $table->string('citizenship');
            $table->string('region');
            $table->string('province');
            $table->string('city_muni');
            $table->string('barangay');
            $table->string('profession');
            $table->string('phone');
            $table->string('role');
            $table->string('status');
            $table->string('username');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('user_password');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
