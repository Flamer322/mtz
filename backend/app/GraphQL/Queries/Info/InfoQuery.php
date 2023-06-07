<?php

declare(strict_types=1);

namespace App\GraphQL\Queries\Info;

final class InfoQuery
{
    public function __invoke($_, array $args): array
    {
        return [
            'version' => '1.0',
        ];
    }
}
