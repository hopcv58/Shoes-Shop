<?php

namespace App\Responsitory;

use Illuminate\Database\Eloquent\Model;

class Slides extends Model
{
    protected $table = 'slides';

    protected $fillable = [
        'name',
        'is_public',
    ];

    public function rule()
    {
        return [
            'name' => 'max:191',
            'is_public' => 'digits',
        ];
    }
}
