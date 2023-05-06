<?php

namespace App\GraphQL\Mutations\Auth;

use Exception;
use Illuminate\Support\Facades\Cookie;
use Nuwave\Lighthouse\Exceptions\DefinitionException;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;
use Psr\Log\LoggerInterface;

final class LogoutMutation
{
    public function __construct(
        private readonly LoggerInterface $logger
    ) {
    }

    public function __invoke($_, array $args, GraphQLContext $context): array
    {
        try {
            Cookie::queue(Cookie::forget('token'), $context->request->getHost());

            auth()->logout();
        } catch (Exception $e) {
            $this->logger->error($e);
            throw new DefinitionException($e->getMessage());
        }

        return [
            'success' => true,
        ];
    }
}
