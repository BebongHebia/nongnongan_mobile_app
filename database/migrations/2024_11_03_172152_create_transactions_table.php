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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->string('transaction_code');
            $table->integer('user_id');
            $table->string('document_type');
            $table->string('name');
            $table->string('address');
            $table->string('bday');
            $table->string('bplace');
            $table->string('sex');
            $table->string('civil_status');
            $table->string('purpose');
            $table->string('validity');
            $table->string('or_no');
            $table->string('status');
            $table->string('ref_no');
            $table->string('remarks');
            $table->string('schedule');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
