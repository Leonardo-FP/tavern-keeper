<?php

namespace App\Services;

use App\Models\Campaign;

class CampaignService
{
    public function create(array $data)
    {
        $users = $data['campaign_users'];

        // Limpa o array para conseguir inserir no banco
        unset($data['campaign_users']);

        $data['status_id'] = 1;

        $campaign = Campaign::create($data);

        // Adicionar o usuário criador como admin
        $campaign->users()->attach($users);

        return $campaign;
    }
}
