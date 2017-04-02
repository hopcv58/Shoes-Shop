<?php

namespace App\Responsitory;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Customers extends Authenticatable
{
    protected $table = 'customers';
    protected $guarded = 'customer';

    /**
     * The attribute are mass assignable
     * @var array
     */
    protected $fillable = [
        'username',
        'password',
        'email',
        'address',
        'phone',
    ];

    /**
     * The attribute should be hidden for array
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token'
    ];

    public function rule()
    {
        return [
            'username' => 'required|min:3|max:191',
            'password' => 'required|min:6|max:191',
            'email' => 'required|min:3|max:191|email',
            'address' => 'required|min:3|max:191',
            'phone' => 'min:8|digits',
        ];
    }

    public function ruleLogin(){
        return [
            'email' => 'required|email|max:191|min:3',
            'password' => 'required|min:6',
        ];
    }
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
