<?php

namespace App\GraphQL\Mutations\Auth;

use Illuminate\Support\Facades\Cookie;
use Nuwave\Lighthouse\Exceptions\AuthenticationException;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;
use Tymon\JWTAuth\Facades\JWTAuth;

final class SignInMutation
{
    public function __invoke($_, array $args, GraphQLContext $context): array
    {
        if (!$token = JWTAuth::attempt(['email' => $args['input']['email'], 'password' => $args['input']['password']])) {
            throw new AuthenticationException('Не удалось авторизовать, ошибка в email или пароле');
        }

        Cookie::queue('token', $token, 1440, '/', $context->request->getHost(), false, true);

        return [
            'success' => true,
        ];
    }
}
