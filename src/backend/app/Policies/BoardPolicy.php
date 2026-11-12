<?php

namespace App\Policies;

use App\Models\Board;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class BoardPolicy
{
    public function viewAny(User $user): bool
    {
        return false;
    }

    public function view(User $user, Board $board): bool
    {
        return $board->users()->whereKey($user->id)->exists();
    }

    public function create(User $user): bool
    {
        return true;
    }

    public function leave(User $user, Board $board): bool
    {
        return $this->view($user, $board);
    }

    public function update(User $user, Board $board): bool
    {
        return $board->isAdmin($user);
    }

    public function delete(User $user, Board $board): bool
    {
        return false;
    }

    public function removeUsers(User $user, Board $board): bool
    {
        return $board->isAdmin($user);
    }

    public function restore(User $user, Board $board): bool
    {
        return false;
    }

    public function forceDelete(User $user, Board $board): bool
    {
        return false;
    }
}
