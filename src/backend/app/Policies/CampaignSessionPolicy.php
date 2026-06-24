<?php

namespace App\Policies;

use App\Models\CampaignSession;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class CampaignSessionPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return false;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, CampaignSession $campaignSession): bool
    {
        return false;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return false;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, CampaignSession $campaignSession): bool
    {
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, CampaignSession $campaignSession): bool
    {
        return $campaignSession->campaign->isGm($user);
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, CampaignSession $campaignSession): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, CampaignSession $campaignSession): bool
    {
        return false;
    }
}
