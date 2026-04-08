<?php

namespace App\Services;

use App\Http\Resources\CampaignResource;
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
    
    public function show($id)
    {
        $campaign = Campaign::findOrFail($id);

        return new CampaignResource($campaign);
    }

    public function join($id)
    {
        $campaign = Campaign::findOrFail($id);

        if (! $campaign->users()->where('user_id', auth()->id())->exists()) {
            $campaign->users()->attach(auth()->id(), [
                'role' => 'player'
            ]);
        }

        return $campaign;
    }
}
