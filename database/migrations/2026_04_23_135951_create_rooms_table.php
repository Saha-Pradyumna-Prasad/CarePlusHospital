<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('rooms', function (Blueprint $table) {
            $table->id();
            $table->string('room_number')->unique();
            $table->string('name');
            $table->enum('type', [
                'patient_ward', 'doctor_room', 'xray_room', 'ultra_scan_room',
                'icu', 'emergency', 'ot', 'reception', 'report_room',
                'washroom', 'lab_room', 'canteen'
            ]);
            $table->enum('status', ['occupied', 'available', 'maintenance'])->default('available');
            $table->integer('floor');
            $table->integer('capacity');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('rooms');
    }
};