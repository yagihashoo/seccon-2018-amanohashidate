<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Challenge;
use Illuminate\Auth\Access\HandlesAuthorization;

class ChallengePolicy
{
    use HandlesAuthorization;

    public function create(User $user)
    {
        return $user->role_id === User::ROLE_SETTER;
    }

    public function save(User $user, Challenge $challenge)
    {
        return $user->id === $challenge->setter_id;
    }

    public function verify(User $user, Challenge $challenge)
    {
        return $user->role_id === User::ROLE_ADMIN;
    }
}
