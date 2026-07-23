<?php

namespace App\Services;

use App\Models\CampaignSession;

class CampaignSessionService
{
    public function create(array $data)
    {
        $session = CampaignSession::create($data);

        return $session;
    }

    public function show($id)
    {
        $campaignSession = CampaignSession::with(['campaign', 'entries'])->findOrFail($id);

        return $campaignSession;
    }

    public function delete(CampaignSession $campaignSession): bool
    {
        return $campaignSession->delete();
    }
}