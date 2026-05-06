<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PA extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'pas';
    
    protected $fillable = [
        'user_id', 'pa_id', 'name', 'email', 'phone',
        'doctor_id', 'photo', 'status'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }
}