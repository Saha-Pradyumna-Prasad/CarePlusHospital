<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Doctor extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id', 'doctor_id', 'name', 'designation', 'specialty',
        'degree', 'email', 'phone', 'photo', 'status'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function pas()
    {
        return $this->hasMany(PA::class);
    }

    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }
}