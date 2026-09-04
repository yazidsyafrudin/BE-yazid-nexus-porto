<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Guestbook extends Model
{
    protected $fillable = [
        'name',
        'avatar',
        'location',
        'category',
        'message',
        'likes',
        'is_pro',
    ];

    protected $casts = [
        'likes' => 'integer',
        'is_pro' => 'boolean',
    ];
}
