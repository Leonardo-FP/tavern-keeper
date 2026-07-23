<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SessionEntry extends Model
{
    protected $fillable = [
        'campaign_session_id',
        'user_id',
        'content'
    ];

    public function session()
    {
        return $this->belongsTo(CampaignSession::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}