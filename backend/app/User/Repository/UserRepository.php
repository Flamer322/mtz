<?php

namespace App\User\Repository;

use App\User\Entity\User;
use DomainException;

final class UserRepository
{
    public function get(int $id): User
    {
        return User::where(['id' => $id])->firstOrFail();
    }

    public function save(User $user): void
    {
        if (!$user->save()) {
            throw new DomainException('Возникла ошибка при сохранении пользователя');
        }
    }

    public function remove(User $user): void
    {
        if (!$user->delete()) {
            throw new DomainException('Возникла ошибка при удалении пользователя');
        }
    }

    public function findById(int $userId): ?User
    {
        if (!$user = User::whereId($userId)->first()) {
            throw new DomainException('Пользователь не найден');
        }

        return $user;
    }
}
