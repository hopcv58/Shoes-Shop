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

    public function comment()
    {
        return $this->morphMany('App\Responsitory\Comments', 'commentable');
    }

    public function users()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

}