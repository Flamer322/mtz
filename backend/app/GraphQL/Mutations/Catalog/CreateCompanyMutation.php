<?php

namespace App\GraphQL\Mutations\Catalog;

use App\Catalog\Command\Company\Create;
use Exception;
use Nuwave\Lighthouse\Exceptions\DefinitionException;
use Psr\Log\LoggerInterface;

final class CreateCompanyMutation
{
    public function __construct(
        private readonly Create\Handler $handler,
        private readonly LoggerInterface $logger
    ) {
    }

    public function __invoke($_, array $args): array
    {
        try {
            $company = $this->handler->handle(
                Create\Command::from($args['input']),
                request()->user()->id
            );
        } catch (Exception $e) {
            $this->logger->error($e);

            throw new DefinitionException($e->getMessage());
        }

        return [
            'id' => $company->id,
        ];
    }
}
