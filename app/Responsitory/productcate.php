<?php

namespace App\Responsitory;

use Illuminate\Database\Eloquent\Model;

class productcate extends Model
{
    protected $table = 'productcate';
    protected $fillable = [
        'product_id',
        'cate_id',
    ];

    public function products()
    {
        return $this->belongsTo(Products::class,'product_id','id');
    }

    public function categories()
    {
        return $this->belongsTo(Categories::class,'cate_id','id');
    }
}
