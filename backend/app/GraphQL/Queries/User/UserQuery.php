<?php

namespace App\GraphQL\Queries\User;

use Illuminate\Support\Facades\Cookie;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;

class UserQuery
{
    public function __invoke($root, array $args, GraphQLContext $context)
    {
        $token = auth()->refresh();

        Cookie::queue('token', $token, 1440, '/', $context->request->getHost(), false, true);

        return $context->request()->user();
    }
}
