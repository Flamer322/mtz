<?php

declare(strict_types=1);

namespace App\GraphQL\Validators\Catalog;

use Nuwave\Lighthouse\Validation\Validator;

final class CreateCompanyValidator extends Validator
{
    public function rules(): array
    {
        return [
            'legalName' => ['required', 'string', 'max: 255'],
            'legalAddress' => ['string', 'max: 255'],
            'postAddress' => ['string', 'max: 255'],
            'inn' => ['string', 'max: 255'],
            'okpo' => ['string', 'max: 255'],
            'kpp' => ['string', 'max: 255'],
            'ogrn' => ['string', 'max: 255'],
            'bik' => ['string', 'max: 255'],
            'corrAccount' => ['string', 'max: 255'],
            'bankAccount' => ['string', 'max: 255'],
            'mainOrganization' => ['string', 'max: 255'],
            'shortName' => ['string', 'max: 255'],
            'bankName' => ['string', 'max: 255'],
            'directorPost' => ['string', 'max: 255'],
            'directorName' => ['string', 'max: 255'],
        ];
    }
}
