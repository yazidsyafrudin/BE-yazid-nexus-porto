<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Experience extends Model
{
    protected $fillable = [
        'company',
        'logo',
        'role_id',
        'role_en',
        'location_id',
        'location_en',
        'period_id',
        'period_en',
        'duration_id',
        'duration_en',
        'employment_id',
        'employment_en',
        'arrangement_id',
        'arrangement_en',
        'tasks',
        'learnings',
        'impact',
        'order',
    ];

    protected $casts = [
        'tasks' => 'array',
        'learnings' => 'array',
        'impact' => 'array',
        'order' => 'integer',
    ];
}
