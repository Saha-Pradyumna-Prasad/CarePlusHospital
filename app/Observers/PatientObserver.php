<?php

namespace App\Observers;

use App\Models\Patient;

class PatientObserver
{
    public function creating(Patient $patient): void
    {
        if (!$patient->patient_id) {
            $latest = Patient::withTrashed()->latest('id')->first();
            $nextId = $latest ? intval(substr($latest->patient_id, 3)) + 1 : 1;
            $patient->patient_id = 'PT-' . str_pad($nextId, 4, '0', STR_PAD_LEFT);
        }
    }
}