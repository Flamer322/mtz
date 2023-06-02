<?php

declare(strict_types=1);

namespace App\GraphQL\Validators\Catalog;

use Nuwave\Lighthouse\Validation\Validator;

final class CreateOrderValidator extends Validator
{
    public function rules(): array
    {
        return [
            'buyerCompany' => ['required', 'int', 'exists:App\Catalog\Entity\ClientCompany,id'],
            'payerCompany' => ['required', 'int', 'exists:App\Catalog\Entity\ClientCompany,id'],
            'recipientCompany' => ['required', 'int', 'exists:App\Catalog\Entity\ClientCompany,id'],
            'contactName' => ['string', 'max: 255'],
            'contactPhone' => ['string', 'max: 255'],
            'contactEmail' => ['string', 'max: 255'],
            'documentType' => ['string', 'max: 255'],
            'comment' => ['string', 'max: 255'],
            'endUserOfProduct' => ['string', 'max: 255'],
            'deliveryDate' => ['string', 'max: 255'],
            'files' => ['array'],
            'files.*' => ['required', 'file'],
        ];
    }
}
