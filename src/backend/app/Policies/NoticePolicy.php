<?php

namespace App\Policies;

use App\Models\Notice;
use App\Models\User;
use App\Models\Board;

class NoticePolicy
{
    public function viewAny(User $user, Board $board): bool
    {
        return $board->users()->whereKey($user->id)->exists();
    }

    public function view(User $user, Notice $notice): bool
    {
        if($notice->campaign_id){
            return $notice->campaign?->users()->whereKey($user->id)->exists() ?? false;
        }

        return $notice->board?->users()->whereKey($user->id)->exists() ?? false;
    }

    public function create(User $user): bool
    {
        return false;
    }

    public function update(User $user, Notice $notice): bool
    {
        return false;
    }

    public function delete(User $user, Notice $notice): bool
    {
        return false;
    }

    public function restore(User $user, Notice $notice): bool
    {
        return false;
    }

    public function forceDelete(User $user, Notice $notice): bool
    {
        return false;
    }
}
