<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
 
    protected $fillable = [
        'user_id',
        'total_amount',
        'status',
        'shipping_address',
        'payment_reference',
        'payment_method',
        'paid_at',
        ];

    protected $casts = [
    'paid_at' => 'datetime',
    ];

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

      public function user()
    {
        return $this->belongsTo(User::class);
    }

}
