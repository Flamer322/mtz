<?php

declare(strict_types=1);

namespace App\Catalog\Policies;

use App\User\Entity\User;
use Illuminate\Auth\Access\HandlesAuthorization;

final class ClientCompanyPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {
        return in_array($user->role, [User::ROLE_ADMIN, User::ROLE_ORDER_MANAGER]);
    }

    public function view(User $user): bool
    {
        return in_array($user->role, [User::ROLE_ADMIN, User::ROLE_ORDER_MANAGER]);
    }

    public function create(User $user): bool
    {
        return false;
    }

    public function update(User $user): bool
    {
        return false;
    }

    public function delete(User $user): bool
    {
        return false;
    }
}
