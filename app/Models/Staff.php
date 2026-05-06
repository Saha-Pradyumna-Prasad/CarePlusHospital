<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Staff extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id', 'staff_id', 'name', 'role_type',
        'email', 'phone', 'photo', 'status'
    ];
    
    protected static function boot()
    {
        parent::boot();
        
        static::creating(function ($staff) {
            $latest = Staff::withTrashed()->latest('id')->first();
            $nextId = $latest ? intval(substr($latest->staff_id, 3)) + 1 : 1;
            $staff->staff_id = 'ST-' . str_pad($nextId, 4, '0', STR_PAD_LEFT);
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}