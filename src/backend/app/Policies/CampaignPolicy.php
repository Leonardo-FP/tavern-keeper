<?php

namespace App\Policies;

use App\Models\Campaign;
use App\Models\Board;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class CampaignPolicy
{
    public function viewAny(User $user): bool
    {
        return false;
    }

    public function view(User $user, Campaign $campaign): bool
    {
        return $this->join($user, $campaign)
            && $campaign->users()->whereKey($user->id)->exists();
    }

    public function create(User $user, Board $board): bool
    {
        return $board->isAdmin($user);
    }

    public function join(User $user, Campaign $campaign): bool
    {
        return $campaign->board?->users()->whereKey($user->id)->exists() ?? false;
    }

    public function leave(User $user, Campaign $campaign): bool
    {
        return $campaign->users()->whereKey($user->id)->exists();
    }

    public function update(User $user, Campaign $campaign): bool
    {
       return $this->view($user, $campaign) && $campaign->isGm($user);
    }

    public function delete(User $user, Campaign $campaign): bool
    {
        return false;
    }

    public function restore(User $user, Campaign $campaign): bool
    {
        return false;
    }

    public function forceDelete(User $user, Campaign $campaign): bool
    {
        return false;
    }
}
