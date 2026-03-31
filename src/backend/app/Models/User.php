<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasApiTokens;

    protected $fillable = [
        'name',
        'email',
        'nickname',
        'gender_id',
        'icon_id',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function icon(): BelongsTo
    {
        return $this->belongsTo(Icon::class);
    }

    public function gender(): BelongsTo
    {
        return $this->belongsTo(Gender::class);
    }

    public function boards()
    {
        return $this->belongsToMany(Board::class, 'board_user')
                    ->withPivot('is_admin')
                    ->withTimestamps();
    }

    public function campaigns()
    {
        return $this->belongsToMany(Campaign::class)
                    ->withPivot('role')
                    ->withTimestamps();
    }
}
