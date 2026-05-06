<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
// use Laravel\Sanctum\HasApiTokens;   

class User extends Authenticatable
{
    use HasFactory, Notifiable;
   // use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'name', 'email', 'password', 'role',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'role' => 'string',
        ];
    }

    public function doctor()
    {
        return $this->hasOne(Doctor::class);
    }

    public function pa()
    {
        return $this->hasOne(PA::class);
    }

    public function staff()
    {
        return $this->hasOne(Staff::class);
    }

    public function patient()
    {
        return $this->hasOne(Patient::class);
    }
}