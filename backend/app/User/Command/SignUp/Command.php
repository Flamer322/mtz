<?php

namespace App\User\Command\SignUp;

use Spatie\LaravelData\Data;

final class Command extends Data
{
    public function __construct(
        public string $name,
        public string $email,
        public string $password,
        public string $phone,
    )
    {
    }
}
