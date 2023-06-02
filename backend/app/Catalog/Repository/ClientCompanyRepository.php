<?php

namespace App\Catalog\Repository;

use App\Catalog\Entity\ClientCompany;
use DomainException;

final class ClientCompanyRepository
{
    public function get(int $id): ClientCompany
    {
        return ClientCompany::where(['id' => $id])->firstOrFail();
    }

    public function save(ClientCompany $company): void
    {
        if (!$company->save()) {
            throw new DomainException('Возникла ошибка при сохранении компании');
        }
    }

    public function remove(ClientCompany $company): void
    {
        if (!$company->delete()) {
            throw new DomainException('Возникла ошибка при удалении компании');
        }
    }

    public function findById(int $companyId): ?ClientCompany
    {
        if (!$company = ClientCompany::whereId($companyId)->first()) {
            throw new DomainException('Компания не найдена');
        }

        return $company;
    }
}
