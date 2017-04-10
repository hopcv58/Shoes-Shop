<?php

namespace App\Responsitory;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Comments extends Model
{
    protected $table = 'comments';

    protected $fillable = [
        'content',
        'customer_id',
        'commentable_id',
        'commentable_type',
    ];

    public function rule()
    {
        return [
            'rule' => 'required|min:3',
        ];
    }

    public function commentable()
    {
        return $this->morphTo();
    }

    public function customers()
    {
        return $this->belongsTo(Customers::class, 'customer_id', 'id');
    }
}
