<?php

namespace App\GraphQL\Validators\Auth;

use Nuwave\Lighthouse\Validation\Validator;

final class SignInValidator extends Validator
{
    public function rules(): array
    {
        return [
            'email' => ['required', 'string', 'email', 'max:255'],
            'password' => ['required', 'string', 'min:6', 'max:255'],
        ];
    }
}
