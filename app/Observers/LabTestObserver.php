<?php

namespace App\Observers;

use App\Models\LabTest;

class LabTestObserver
{
    public function creating(LabTest $labTest): void
    {
        if (!$labTest->test_id) {
            $latest = LabTest::latest('id')->first();
            $nextId = $latest ? intval(substr($latest->test_id, 4)) + 1 : 1;
            $labTest->test_id = 'TST-' . str_pad($nextId, 4, '0', STR_PAD_LEFT);
        }
    }
}