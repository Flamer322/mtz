<?php

namespace App\Claim\Repository;

use App\Claim\Entity\Claim;

final class ClaimRepository
{
    public function countByProductId(int $productId): int
    {
        return Claim::whereProductId($productId)->count();
    }
}
