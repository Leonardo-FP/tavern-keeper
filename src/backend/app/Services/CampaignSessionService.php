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
}
