<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('lab_tests', function (Blueprint $table) {
            $table->id();
            $table->string('test_id')->unique();
            $table->foreignId('patient_id')->constrained('patients');
            $table->string('bottle_id')->nullable();
            $table->string('test_type');
            $table->text('result')->nullable();
            $table->enum('status', ['pending', 'processing', 'completed'])->default('pending');
            $table->foreignId('performed_by')->constrained('users');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('lab_tests');
    }
};