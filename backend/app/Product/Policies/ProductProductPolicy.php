<?php

declare(strict_types=1);

namespace App\Product\Policies;

use App\User\Entity\User;
use Illuminate\Auth\Access\HandlesAuthorization;

final class ProductProductPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {
        return in_array($user->role, [User::ROLE_ADMIN, User::ROLE_PRODUCT_MANAGER, User::ROLE_ORDER_MANAGER]);
    }

    public function view(User $user): bool
    {
        return in_array($user->role, [User::ROLE_ADMIN, User::ROLE_PRODUCT_MANAGER, User::ROLE_ORDER_MANAGER]);
    }

    public function create(User $user): bool
    {
        return in_array($user->role, [User::ROLE_ADMIN, User::ROLE_PRODUCT_MANAGER]);
    }

    public function update(User $user): bool
    {
        return in_array($user->role, [User::ROLE_ADMIN, User::ROLE_PRODUCT_MANAGER]);
    }

    public function delete(User $user): bool
    {
        return in_array($user->role, [User::ROLE_ADMIN, User::ROLE_PRODUCT_MANAGER]);
    }

    public function replicate(User $user): bool
    {
        return false;
    }

    public function attachAnyProduct(User $user): bool
    {
        return in_array($user->role, [User::ROLE_ADMIN, User::ROLE_PRODUCT_MANAGER]);
    }
}
