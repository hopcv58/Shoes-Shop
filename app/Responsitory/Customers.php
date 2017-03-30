<?php

namespace App\Responsitory;

use Illuminate\Database\Eloquent\Model;

class Customers extends Model
{
    protected $table = 'customers';

    protected $fillable = [
        'username',
        'password',
        'email',
        'address',
        'phone',
    ];

    public function comments()
    {
        return $this->hasMany(Comments::class, 'customer_id', 'id');
    }

    public function feedbacks()
    {
        return $this->hasMany(Feedbacks::class, 'customer_id', 'id');
    }

    public function orders()
    {
        return $this->hasMany(Orders::class, 'customer_id', 'id');
    }
}
