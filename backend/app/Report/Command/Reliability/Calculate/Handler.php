<?php

namespace App\Report\Command\Reliability\Calculate;

use App\Claim\Entity\OperatingTime;
use App\Claim\Repository\ClaimRepository;
use App\Dictionary\Entity\CarriageSeries;
use App\Product\Entity\Product;
use App\Product\Repository\ProductRepository;
use App\Report\Entity\AlgorithmParameter;
use App\Report\Entity\Reliability;
use App\Report\Repository\AlgorithmParameterRepository;
use App\Report\Repository\ReliabilityRepository;

final class Handler
{
    public function __construct(
        private readonly ReliabilityRepository $reliabilities,
        private readonly AlgorithmParameterRepository $params,
        private readonly ProductRepository $products,
        private readonly ClaimRepository $claims,
    )
    {
    }

    public function handle(): void
    {
        $p = $this->params->findByKey('p');

        $this->reliabilities->truncate();

        if ($products = $this->products->findAll()) {
            foreach ($products as $product) {
                /** @var Product $product */

                $sumOperating = 0;

                if ($product->series) {
                    foreach ($product->series as $productSeries) {
                        /** @var CarriageSeries $productSeries */

                        if ($operatingList = $productSeries->operating) {
                            foreach ($operatingList as $operating) {
                                /** @var OperatingTime $operating */

                                $sumOperating += ($operating->mileage * $productSeries->pivot->quantity * $operating->count_carriage);
                            }
                        }
                    }
                }

                if ((!$d = $this->claims->countByProductId($product->id))
                    || ($sumOperating == 0)) {
                    continue;
                }

                $pointFailureRate = $d / $sumOperating;

                $x = AlgorithmParameter::getX(
                    (2 * $d + 2),
                    $p->value
                );

                $topPointFailureRate = ($pointFailureRate * ($x)) / 2 * $d;

                $reliability = new Reliability([
                    'failure_number' => $d,
                    'total_operating' => $sumOperating,
                    'point_rate' => $pointFailureRate,
                    'top_rate' => $topPointFailureRate,
                ]);

                $reliability->product()->associate($product);

                $this->reliabilities->save($reliability);
            }
        }
    }
}
