<?php

namespace App\GraphQL\Mutations\Catalog;

use App\Catalog\Command\Order\Create;
use Exception;
use Nuwave\Lighthouse\Exceptions\DefinitionException;
use Psr\Log\LoggerInterface;

final class CreateOrderMutation
{
    public function __construct(
        private readonly Create\Handler $handler,
        private readonly LoggerInterface $logger
    ) {
    }

    public function __invoke($_, array $args): array
    {
        try {
            $order = $this->handler->handle(
                Create\Command::from($args['input']),
                request()->user()->id
            );
        } catch (Exception $e) {
            $this->logger->error($e);

            throw new DefinitionException($e->getMessage());
        }

        return [
            'id' => $order->id,
        ];
    }
}
