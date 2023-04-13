<?php

namespace App\User\Command\Create;

use Spatie\DataTransferObject\DataTransferObject;

final class Command extends DataTransferObject
{
    public string $name;
    public string $email;
    public string $password;
    public string $role;

    public static function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max: 255'],
            'email' => ['required', 'email', 'unique:App\User\Entity\User,email', 'max:255'],
            'password' => ['required', 'min:6', 'max:255'],
            'role' => ['required', 'string', 'max: 30'],
        ];
    }
}
