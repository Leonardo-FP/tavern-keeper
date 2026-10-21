<?php

namespace App\Services;

use App\Models\CampaignSession;
use App\Models\SessionEntry;
use App\Models\User;

class CampaignSessionEntryService
{
    public function create(
        CampaignSession $session,
        User $user,
        string $content
    ): SessionEntry {
        $entry = $session->entries()->create([
            'user_id' => $user->id,
            'content' => $content,
        ]);

        return $entry->load('user');
    }
}