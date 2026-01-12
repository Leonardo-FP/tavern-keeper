<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Board extends Model
{
    protected $fillable = [
        'name',
        'password',
        'is_private',
        'users_limit',
    ];

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'board_user')
                    ->withPivot('is_admin')
                    ->withTimestamps();
    }

    public function campaigns(): HasMany
    {
        return $this->hasMany(Campaign::class);
    }

    protected function casts(): array
    {
        return [
            'is_private' => 'boolean',
            'created_at' => 'datetime:d/m/Y H:i',
            'updated_at' => 'datetime:d/m/Y',
        ];
    }
}