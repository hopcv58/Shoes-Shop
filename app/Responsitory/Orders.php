<?php

namespace App\Responsitory;

use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    protected $table = 'orders';

    protected $fillable = [
        'name',
        'customer_id',
        'status',
        'total',
        'payment',
        'payment_info',
        'note',
        'username',
        'user_address',
        'user_phone',
        'user_email',
    ];

    public function productOrders()
    {
        return $this->hasMany(productOrder::class, 'order_id', 'id');
    }

    public function customers()
    {
        return $this->belongsTo(Customers::class, 'customer_id', 'id');
    }
}
