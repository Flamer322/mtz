<?php

namespace App\Nova\User\Observers;

use App\Service\PasswordGenerator;
use App\User\Entity\User;
use App\User\Mail\SignUpSender;
use Illuminate\Contracts\Hashing\Hasher;
use Illuminate\Mail\Mailer;

final class UserObserver
{
    public function __construct(

        private readonly PasswordGenerator $passwordGenerator,
        private readonly Hasher $hasher,
        private readonly Mailer $mailer,
    )
    {
    }

    public function creating(User $user): void
    {
        $user->password = $this->hasher->make(
            $password = $this->passwordGenerator->generate()
        );

        $this->mailer->send(
            new SignUpSender(
                $user,
                $password
            )
        );
    }
}
