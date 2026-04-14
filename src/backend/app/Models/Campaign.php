<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Enums\CampaignRole;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Campaign extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'name',
        'board_id',
        'status_id',
    ];

    protected $casts = [
        'role' => CampaignRole::class,
    ];

    public function board(): BelongsTo
    {
        return $this->belongsTo(Board::class);
    }

    public function status(): BelongsTo
    {
        return $this->belongsTo(Status::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class)
            ->withPivot('role')
            ->withTimestamps();
    }

    public function sessions(): HasMany
    {
        return $this->hasMany(CampaignSession::class);
    }

    protected function casts(): array
    {
        return [
            'created_at' => 'datetime:d/m/Y H:i',
            'updated_at' => 'datetime:d/m/Y',
        ];
    }
}
