<?php

declare(strict_types=1);

namespace App\User\Policies;

use App\User\Entity\User;
use Illuminate\Auth\Access\HandlesAuthorization;

final class UserPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {
        return $user->role == User::ROLE_ADMIN;
    }

    public function view(User $user): bool
    {
        return $user->role == User::ROLE_ADMIN;
    }

    public function create(User $user): bool
    {
        return $user->role == User::ROLE_ADMIN;
    }

    public function update(User $user): bool
    {
        return $user->role == User::ROLE_ADMIN;
    }

    public function delete(User $user): bool
    {
        return $user->role == User::ROLE_ADMIN;
    }
}
