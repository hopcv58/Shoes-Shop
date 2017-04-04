<?php

namespace App\Responsitory;

use Illuminate\Database\Eloquent\Model;

class productcate extends Model
{
    protected $table = 'productcate';

    public function products()
    {
        return $this->belongsTo(Products::class,'product_id','id');
    }

    public function categories()
    {
        return $this->belongsTo(Categories::class,'cate_id','id');
    }
}
