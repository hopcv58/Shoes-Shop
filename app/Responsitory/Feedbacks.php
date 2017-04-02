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

    public function rule()
    {
        return [
            'username' => 'min:3|max:191',
            'content' => 'required|min:3',
            'email' => 'min:3|max:191|email',
            'phone' => 'min:3|max:20',
        ];
    }

    public function customers()
    {
        return $this->belongsTo(Customers::class, 'customer_id', 'id');
    }
}
