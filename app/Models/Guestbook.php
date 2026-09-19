<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Guestbook extends Model
{
    protected $fillable = [
        'parent_id',
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

    /**
     * Balasan untuk pesan ini.
     */
    public function replies(): HasMany
    {
        return $this->hasMany(Guestbook::class, 'parent_id')->oldest();
    }

    /**
     * Pesan induk jika ini adalah balasan.
     */
    public function parent(): BelongsTo
    {
        return $this->belongsTo(Guestbook::class, 'parent_id');
    }
}
