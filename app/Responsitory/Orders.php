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

    public function rule()
    {
        return [
            'name' => 'min:3|max:191',
            'status' => 'digits',
            'total' => 'digits',
            'payment' => 'required|min:3|max:191',
            'payment_info' => 'min:3|max:191',
            'note' => 'min:3',
            'username' => 'min:3|max:191',
            'user_address' => 'min:3|max:191',
            'user_phone' => 'digits|min:8',
            'user_email' => 'email|unique',
        ];
    }

    public function productOrders()
    {
        return $this->hasMany(productOrder::class, 'order_id', 'id');
    }

    public function customers()
    {
        return $this->belongsTo(Customers::class, 'customer_id', 'id');
    }
}
