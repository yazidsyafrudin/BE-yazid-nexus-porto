<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Education extends Model
{
    protected $table = 'education';

    protected $fillable = [
        'school',
        'logo',
        'degree_id',
        'degree_en',
        'major_id',
        'major_en',
        'gpa',
        'period',
        'location_id',
        'location_en',
        'order',
    ];

    protected $casts = [
        'order' => 'integer',
    ];
}
