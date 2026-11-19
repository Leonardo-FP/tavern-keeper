<?php

namespace App\Policies;

use App\Models\Notice;
use App\Models\User;
use App\Models\Board;
use App\Models\Campaign;

class NoticePolicy
{
    public function viewAny(User $user, Board|Campaign $context): bool
    {
        return $context->users()->whereKey($user->id)->exists();
    }

    public function view(User $user, Notice $notice): bool
    {
        if($notice->campaign_id){
            return $notice->campaign?->users()->whereKey($user->id)->exists() ?? false;
        }

        return $notice->board?->users()->whereKey($user->id)->exists() ?? false;
    }

    public function create(User $user, Board|Campaign $context): bool
    {
        return $this->hasAdministrativeRole($user, $context);
    }

    public function update(User $user, Notice $notice): bool
    {
        return false;
    }

    public function delete(User $user, Notice $notice): bool
    {
        $context = $notice->campaign_id ? $notice->campaign : $notice->board;

        if ($context === null) {
            return false;
        }

        return $this->hasAdministrativeRole($user, $context);
    }

    public function restore(User $user, Notice $notice): bool
    {
        return false;
    }

    public function forceDelete(User $user, Notice $notice): bool
    {
        return false;
    } 

    private function hasAdministrativeRole(User $user, Board|Campaign $context): bool
    {
        if($context instanceof Campaign){
            return $context->isGm($user);
        }
            
        return $context->isAdmin($user);
    }
}
