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
        'description',
        'price',
        'user_id',
        'adver_id',
        'attribute',
        'img_profile',
        'img',
        'is_public',
    ];

    public function comments()
    {
        return $this->morphMany(Comments::class, 'commentable');
    }

    public function categories()
    {
        return $this->belongsToMany(Categories::class, productCate::class, 'product_id', 'cate_id');
    }

    public function advertisments()
    {
        return $this->belongsTo(Advertisments::class, 'ad_id', 'id');
    }

    public function users()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function productOrders()
    {
        return $this->hasMany(productOrder::class, 'product_id', 'id');
    }
}
