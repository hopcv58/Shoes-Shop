<?php

namespace App\Responsitory;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    protected $table = 'products';

    protected $fillable = [
        'name',
        'code',
        'alias',
        'description',
        'price',
        'user_id',
        'adver_id',
        'attribute',
        'img_profile',
        'img',
        'is_public',
    ];

    public function rule()
    {
        return [
            'name' => 'required|min:3|max:191',
            'code' => 'max:191',
            'alias' => 'max:191',
            'price' => 'required|digits',
            'attribute' => 'required',
            'img' => 'required',
            'img_profile' => 'required',
            'is_public' => 'required|digits',
        ];
    }

    public function comments()
    {
        return $this->morphMany(Comments::class, 'commentable');
    }

/*    public function categories()
    {
        return $this->belongsToMany(Categories::class, productcate::class, 'product_id', 'cate_id');
    }*/

    public function advertisments()
    {
        return $this->belongsTo(Advertisments::class, 'ad_id', 'id');
    }

    public function productOrders()
    {
        return $this->hasMany(productOrder::class, 'product_id', 'id');
    }

    public function productCate()
    {
        return $this->hasMany(productcate::class,'product_id','id');
    }
}
