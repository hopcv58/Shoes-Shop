<?php

namespace App\Responsitory;

use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    protected $table = 'categories';
    protected $fillable = [
        'name',
        'is_public',
        'alias',
        'description',
    ];

    public function products()
    {
        return $this->belongsToMany(Products::class, productCate::class, 'cate_id', 'product_id');
    }
    /*
        public function childs()
        {
            return $this->hasMany(Categories::class, 'parent_id');
        }

        public function parents()
        {
            return $this->belongsTo(Categories::class, 'parent_id');
        }
    */
}
