<?php

namespace App\Responsitory;

use Illuminate\Database\Eloquent\Model;

class Advertisments extends BaseModel
{
    protected $table = 'advertisments';
    protected $fillable = [
        'name',
        'detail',
        'start_date',
        'end_date',
        'discount'
    ];

    public function rule(){
        return [
            'name' => 'required|min:3|max:191',
            'discount' => 'max:191',
        ];
    }

    public function products(){
        return $this->hasMany(Products::class, 'ad_id', 'id');
    }
}
