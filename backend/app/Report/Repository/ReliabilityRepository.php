<?php

namespace App\Report\Repository;

use App\Report\Entity\Reliability;
use DomainException;

final class ReliabilityRepository
{
    public function save(Reliability $reliability): void
    {
        if (!$reliability->save()) {
            throw new DomainException('Возникла ошибка при сохранении безотказности');
        }
    }

    public function truncate(): void
    {
        Reliability::truncate();
    }
}
