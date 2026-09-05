<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = [
        'slug', 'title', 'image', 'featured', 'type', 
        'category', 'description_id', 'description_en', 
        'stack', 'reactions'
    ];

    protected $casts = [
        'featured' => 'boolean',
        'stack' => 'array',
        'reactions' => 'array',
    ];
}

