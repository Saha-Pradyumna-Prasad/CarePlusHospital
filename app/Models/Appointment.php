<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

    protected $fillable = [
        'appointment_id', 'patient_name', 'patient_age', 'patient_phone',
        'reason', 'appointment_time', 'doctor_id', 'pa_id', 'status', 'created_by'
    ];

    protected $casts = [
        'appointment_time' => 'datetime',
    ];

    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }

    public function pa()
    {
        return $this->belongsTo(PA::class);
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}