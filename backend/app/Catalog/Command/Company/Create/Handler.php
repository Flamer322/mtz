<?php

declare(strict_types=1);

namespace App\Catalog\Command\Company\Create;

use App\Catalog\Entity\ClientCompany;
use App\Catalog\Repository\ClientCompanyRepository;
use App\User\Repository\UserRepository;

final class Handler
{
    public function __construct(
        private readonly ClientCompanyRepository $companies,
        private readonly UserRepository $users,
    ) {
    }

    public function handle(Command $command, int $userId): ClientCompany
    {
        $company = new ClientCompany([
            'legal_name' => $command->legalName,
            'legal_address' => $command->legalAddress,
            'post_address' => $command->postAddress,
            'inn' => $command->inn,
            'okpo' => $command->okpo,
            'kpp' => $command->kpp,
            'ogrn' => $command->ogrn,
            'bik' => $command->bik,
            'corr_account' => $command->corrAccount,
            'bank_account' => $command->bankAccount,
            'main_organization' => $command->mainOrganization,
            'short_name' => $command->shortName,
            'bank_name' => $command->bankName,
            'director_post' => $command->directorPost,
            'director_name' => $command->directorName,
        ]);

        $company->user()->associate(
            $this->users->findById($userId)
        );

        $this->companies->save($company);

        return $company;
    }
}
