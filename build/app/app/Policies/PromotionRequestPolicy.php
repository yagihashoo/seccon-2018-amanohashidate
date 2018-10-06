<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PromotionRequestPolicy
{
    use HandlesAuthorization;

    public function create(User $user)
    {
        return $user->role_id === User::ROLE_USER;
    }

    public function verify(User $user)
    {
        return $user->role_id === User::ROLE_ADMIN;
    }
}
