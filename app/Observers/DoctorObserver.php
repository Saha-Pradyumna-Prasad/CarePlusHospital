<?php

namespace App\Observers;

use App\Models\Doctor;

class DoctorObserver
{
    public function creating(Doctor $doctor): void
    {
        if (!$doctor->doctor_id) {
            $latest = Doctor::withTrashed()->latest('id')->first();
            $nextId = $latest ? intval(substr($latest->doctor_id, 3)) + 1 : 1;
            $doctor->doctor_id = 'DR-' . str_pad($nextId, 4, '0', STR_PAD_LEFT);
        }
    }
}