<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Achievement extends Model
{
    protected $fillable = [
        'title',
        'issuer',
        'date',
        'image',
        'credential_url',
        'description_id',
        'description_en',
    ];
}
