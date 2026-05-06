<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LabTest extends Model
{
    use HasFactory;

    protected $fillable = [
        'test_id', 'patient_id', 'bottle_id', 'test_type',
        'result', 'status', 'performed_by'
    ];

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    public function performedBy()
    {
        return $this->belongsTo(User::class, 'performed_by');
    }

    public function report()
    {
        return $this->hasOne(Report::class);
    }
}