<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Icon extends Model
{
    /** @use HasFactory<\Database\Factories\UserFactory> */

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'path',
        'type',
    ];

    public function icon(): HasMany
    {
        return $this->hasMany(User::class);
    }
}
