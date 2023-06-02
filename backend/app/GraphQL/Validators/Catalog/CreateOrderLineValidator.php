<?php

declare(strict_types=1);

namespace App\GraphQL\Validators\Catalog;

use Nuwave\Lighthouse\Validation\Validator;

final class CreateOrderLineValidator extends Validator
{
    public function rules(): array
    {
        return [
            'product' => ['required', 'int', 'exists:App\Product\Entity\Product,id'],
            'quantity' => ['required', 'int', 'min:1'],
        ];
    }
}
