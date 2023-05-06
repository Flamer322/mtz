<?php

namespace App\GraphQL\Mutations\Auth;

use App\User\Command\SignUp;
use Exception;
use Nuwave\Lighthouse\Exceptions\DefinitionException;
use Psr\Log\LoggerInterface;

final class SignUpMutation
{
    public function __construct(
        private readonly SignUp\Handler $handler,
        private readonly LoggerInterface $logger
    ) {
    }

    public function __invoke($_, array $args): array
    {
        try {
            $this->handler->handle(
                SignUp\Command::from($args['input'])
            );
        } catch (Exception $e) {
            $this->logger->error($e);
            
            throw new DefinitionException($e->getMessage());
        }

        return [
            'success' => true,
        ];
    }
}
