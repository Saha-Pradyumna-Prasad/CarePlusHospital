
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();
            $table->string('appointment_id')->unique();
            $table->string('patient_name');
            $table->integer('patient_age');
            $table->string('patient_phone');
            $table->text('reason');
            $table->dateTime('appointment_time');
            $table->foreignId('doctor_id')->constrained('doctors');
            $table->foreignId('pa_id')->constrained('pas');
            
            $table->enum('status', ['pending', 'confirmed', 'cancelled', 'completed'])->default('pending');
            $table->foreignId('created_by')->constrained('users');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('appointments');
    }
};