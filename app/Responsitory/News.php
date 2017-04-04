<?php

namespace App\Responsitory;

use App\User;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    protected $table = 'news';

    protected $fillable = [
        'title',
        'content',
        'img',
        'summary',
        'is_public',
        'user_id',
    ];

    public function rule()
    {
        return [
            'title' => 'required|min:3|max:191|unique:title',
            'content' => 'required|min:3',
        ];
    }


    public function comment()
    {
        return $this->morphMany('App\Responsitory\Comments', 'commentable');
    }

}
