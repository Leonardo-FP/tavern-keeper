<?php

namespace App\Policies;

use App\Models\CampaignSession;
use App\Models\Campaign;
use App\Models\User;

class CampaignSessionPolicy
{
    public function viewAny(User $user): bool
    {
        return false;
    }

    public function view(
        User $user,
        CampaignSession $campaignSession
    ): bool {
        return $this->isCampaignParticipant($user, $campaignSession);
    }

    public function create(User $user, Campaign $campaign): bool
    {
        return $user->can('update', $campaign);
    }

    public function createEntry(
        User $user,
        CampaignSession $campaignSession
    ): bool {
        return $this->isCampaignParticipant($user, $campaignSession);
    }

    public function update(
        User $user,
        CampaignSession $campaignSession
    ): bool {
        return false;
    }

    public function delete(
        User $user,
        CampaignSession $campaignSession
    ): bool {
        return $this->isCampaignParticipant($user, $campaignSession)
            && $campaignSession->campaign->isGm($user);
    }

    public function restore(
        User $user,
        CampaignSession $campaignSession
    ): bool {
        return false;
    }

    public function forceDelete(
        User $user,
        CampaignSession $campaignSession
    ): bool {
        return false;
    }

    private function isCampaignParticipant(
        User $user,
        CampaignSession $campaignSession
    ): bool {
        $campaign = $campaignSession->campaign;

        if (!$campaign) {
            return false;
        }

        return $user->can('view', $campaign);
    }
}
