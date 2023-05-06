<?php

declare(strict_types=1);

namespace App\User\Command\SignUp;

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
            'phone' => $command->phone,
            'role' => User::ROLE_CLIENT,
        ]);

        $this->users->save($user);
    }
}
