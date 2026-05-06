<?php

namespace App\Observers;

use App\Models\Staff;

class StaffObserver
{
    public function creating(Staff $staff): void
    {
        if (!$staff->staff_id) {
            $latest = Staff::withTrashed()->latest('id')->first();
            $nextId = $latest ? intval(substr($latest->staff_id, 3)) + 1 : 1;
            $staff->staff_id = 'ST-' . str_pad($nextId, 4, '0', STR_PAD_LEFT);
        }
    }
}