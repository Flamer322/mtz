<?php

namespace App\Claim\Repository;

use App\Claim\Entity\Claim;
use Illuminate\Database\Query\Builder;

final class ClaimRepository
{
    public function countByProductId(int $productId): int
    {
        return Claim::whereProductId($productId)->count();
    }

    public function countByProductIdCompanyIdTypesIdSeriesId(int $productId, ?int $companyId = null,
                                                             ?array $typeIds = null, ?array $seriesIds = null) {
        return Claim::where('product_id', $productId)
            ->when($companyId, function (Builder $query, int $companyId) {
                $query->where('company_d', $companyId);
            })
            ->when($typeIds, function (Builder $query, array $typeIds) {
                $query->whereIn('type_id', $typeIds);
            })
            ->when($seriesIds, function (Builder $query, array $seriesIds) {
                $query->where('series_id', $seriesIds);
            })
            ->count();
    }
}
