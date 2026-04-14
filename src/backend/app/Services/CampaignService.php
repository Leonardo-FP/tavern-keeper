<?php

namespace App\Services;

use App\Http\Resources\CampaignResource;
use App\Models\Campaign;
use App\Models\User;

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
        $campaign = Campaign::with(['users', 'status', 'sessions'])->findOrFail($id);

        return new CampaignResource($campaign);
    }

    public function getMyCampaigns()
    {
        return auth()
            ->user()
            ->campaigns()
            ->withCount(['sessions as total_sessions', 'users as current_players'])
            ->latest()
            ->paginate(6);
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
    
    public function leave(Campaign $campaign, User $user)
    {
        if (!$campaign->users()->where('user_id', $user->id)->exists()) {
            throw new \Exception('Você não pertence à campanha para deixá-la.');
        }

        $membersCount = $campaign->users()->count();

        if ($membersCount === 1) {
            $campaign->users()->detach($user->id);
            $campaign->delete();
            return true;
        }

        $campaign->users()->detach($user->id);

        return true;
    }
}
