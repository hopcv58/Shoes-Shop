<?php

namespace App\Responsitory;

use Illuminate\Database\Eloquent\Model;

class Categories extends BaseModel
{
    protected $table = 'categories';

    protected $fillable = [
        'name',
        'is_public',
        'alias',
        'description',
    ];

    public function rule()
    {
        return [
            'name' => 'required|min:3|max:191|unique:categories',
            'alias' => 'max:191',
        ];
    }
  /*  public function products()
    {
        return $this->belongsToMany(Products::class, productcate::class, 'cate_id', 'product_id');
    }*/

    public function productCate()
    {
        return $this->hasMany(productcate::class,'cate_id','id');
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
