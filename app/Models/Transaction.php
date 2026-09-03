<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $table = 'transactions';

    protected $fillable = [
        'order_id',
        'total',
        'teacher_id',
        'commission',
        'teacher_amount',
        'commission_amount',
    ];

    public function teacher()
    {
        return $this->belongsTo(Teacher::class, 'teacher_id');
    }

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    protected function casts()
    {
        return [
            'commission' => 'float',
            'total' => 'float',
            'teacher_amount' => 'float',
            'commission_amount' => 'float',
        ];
    }
}
