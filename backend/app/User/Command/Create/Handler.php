<?php

declare(strict_types=1);

namespace App\User\Command\Create;

use App\User\Entity\User;
use App\User\Repository\UserRepository;
use Illuminate\Contracts\Hashing\Hasher;

final class Handler
{
    public function __construct(
        private readonly UserRepository $users,
        private readonly Hasher $hasher,
    ) {
    }

    public function handle(Command $command): void
    {
        $user = new User([
            'name' => $command->name,
            'email' => $command->email,
            'password' => $this->hasher->make($command->password),
            'role' => $command->role,
        ]);

        $this->users->save($user);
    }
}
