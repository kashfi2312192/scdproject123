<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'order_number',
        'user_id',
        'name',
        'email',
        'phone',
        'address',
        'payment_method',
        'total',
        'items',
        'status',
    ];

    protected $casts = [
        'items' => 'array',
        'total' => 'decimal:2',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
