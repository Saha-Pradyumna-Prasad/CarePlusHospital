<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('patients', function (Blueprint $table) {
            $table->id();
            $table->string('patient_id')->unique();
            $table->string('name');
            $table->integer('age');
            $table->enum('gender', ['male', 'female', 'other']);
            $table->string('phone');
            $table->string('email')->nullable();
            $table->text('address');
            $table->string('blood_group')->nullable();
            $table->string('emergency_contact');
            $table->foreignId('registered_by')->constrained('users');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('patients');
    }
};