<?php

namespace App\Observers;

use App\Models\PA;

class PAObserver
{
    public function creating(PA $pa): void
    {
        if (!$pa->pa_id) {
            $latest = PA::withTrashed()->latest('id')->first();
            $nextId = $latest ? intval(substr($latest->pa_id, 3)) + 1 : 1;
            $pa->pa_id = 'PA-' . str_pad($nextId, 4, '0', STR_PAD_LEFT);
        }
    }
}