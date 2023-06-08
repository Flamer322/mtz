<?php

namespace App\Report\Repository;

use App\Report\Entity\AlgorithmParameter;
use DomainException;

final class AlgorithmParameterRepository
{

    public function findByKey(string $parameterKey): ?AlgorithmParameter
    {
        if (!$parameter = AlgorithmParameter::where('key', $parameterKey)->first()) {
            throw new DomainException('Параметр не найден');
        }

        return $parameter;
    }
}
