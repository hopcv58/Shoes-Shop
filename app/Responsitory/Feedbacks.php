<?php

namespace App\Responsitory;

use Illuminate\Database\Eloquent\Model;

class Feedbacks extends Model
{
    protected $table = 'feedbacks';

    protected $fillable = [
        'content',
        'customer_id',
        'username',
        'email',
        'phone',
    ];

    public function customers()
    {
        return $this->belongsTo(Customers::class, 'customer_id', 'id');
    }
}
