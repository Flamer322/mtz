<?php

declare(strict_types=1);

namespace App\Claim\Policies;

use App\User\Entity\User;
use Illuminate\Auth\Access\HandlesAuthorization;

final class DefectTypePolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {
        return in_array($user->role, [User::ROLE_ADMIN, User::ROLE_ENGINEER]);
    }

    public function view(User $user): bool
    {
        return in_array($user->role, [User::ROLE_ADMIN, User::ROLE_ENGINEER]);
    }

    public function create(User $user): bool
    {
        return in_array($user->role, [User::ROLE_ADMIN, User::ROLE_ENGINEER]);
    }

    public function update(User $user): bool
    {
        return in_array($user->role, [User::ROLE_ADMIN, User::ROLE_ENGINEER]);
    }

    public function delete(User $user): bool
    {
        return in_array($user->role, [User::ROLE_ADMIN, User::ROLE_ENGINEER]);
    }

    public function replicate(User $user): bool
    {
        return false;
    }
}
