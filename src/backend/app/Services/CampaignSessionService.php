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

    public function delete(CampaignSession $campaignSession): bool
    {
        // Qualquer lógica de negócio antes de deletar (ex: checar permissões) iria aqui
        return $campaignSession->delete();
    }
}
