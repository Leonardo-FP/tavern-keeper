<?php

namespace App\Services;

use App\Models\Campaign;
use Illuminate\Support\Facades\Hash;
use App\Http\Resources\CampaignResource;

class CampaignService
{
    public function create(array $data)
    {
        $campaign = Campaign::create($data);

        // Adicionar o usuário criador como admin
        $campaign->users()->attach($data['campaign_users']);

        return $campaign;
    }
}
