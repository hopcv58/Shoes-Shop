<?php

namespace App\Responsitory;

use Illuminate\Database\Eloquent\Model;

class Advertisments extends Model
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
            'discount' => 'digits_between:0,100',
        ];
    }

    public function products(){
        return $this->hasMany(Product::class, 'ad_id', 'id');
    }
}
