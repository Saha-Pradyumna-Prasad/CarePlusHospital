<?php

namespace App\Observers;

use App\Models\Appointment;

class AppointmentObserver
{
    public function creating(Appointment $appointment): void
    {
        if (!$appointment->appointment_id) {
            $latest = Appointment::latest('id')->first();
            $nextId = $latest ? intval(substr($latest->appointment_id, 4)) + 1 : 1;
            $appointment->appointment_id = 'APT-' . str_pad($nextId, 4, '0', STR_PAD_LEFT);
        }
    }
}