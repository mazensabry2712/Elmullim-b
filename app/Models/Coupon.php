<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    protected $fillable = [
        'code',
        'discount',
        'max_recipients',
        'restricted',
        'usage_limit',
        'usage_limit_per_user',
        'is_active',
        'starts_at',
        'expires_at',
    ];

    public function students()
    {
        return $this->belongsToMany(Student::class, 'coupon_student');
    }
    protected $casts = [
        'restricted' => 'boolean',
        'is_active' => 'boolean',
        'starts_at' => 'datetime',
        'expires_at' => 'datetime',
    ];
    
}
