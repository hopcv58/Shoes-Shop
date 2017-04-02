<?php

namespace App\Responsitory;

use Illuminate\Database\Eloquent\Model;

class productOrder extends Model
{
    protected $table = 'product_order';

    protected $fillable = [
        'product_id',
        'order_id',
        'qty',
        'amount',
        'status',
    ];

    public function rule(){
        return [
            'qty' => 'required|digits',
            'amount' => 'required|digits',
            'status' => 'required|digits',
        ];
    }

    public function orders()
    {
        return $this->belongsTo(Orders::class, 'order_id', 'id');
    }

    public function products()
    {
        return $this->belongsTo(Products::clas, 'product_id', 'id');
    }
}
