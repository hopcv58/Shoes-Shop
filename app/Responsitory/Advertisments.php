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

    public function products(){
        return $this->hasMany(Product::class, 'ad_id', 'id');
    }
}
