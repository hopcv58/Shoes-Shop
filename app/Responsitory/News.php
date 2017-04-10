<?php

namespace App\Responsitory;

use App\User;
use Illuminate\Database\Eloquent\Model;

class News extends BaseModel
{
    protected $table = 'news';

    protected $fillable = [
        'title',
        'content',
        'img',
        'summary',
        'is_public',
    ];

    public function rule()
    {
        return [
            'title' => 'required|min:3|max:191|unique:news',
            'content' => 'required|min:3',
            'img' => 'required',
        ];
    }


    public function comment()
    {
        return $this->morphMany('App\Responsitory\Comments', 'commentable');
    }

}
