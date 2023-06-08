<?php

namespace App\Report\Command\SummaryReport\Generate;

use App\Claim\Entity\OperatingTime;
use App\Claim\Repository\ClaimRepository;
use App\Dictionary\Entity\CarriageSeries;
use App\Dictionary\Entity\CarriageType;
use App\Product\Entity\Product;
use App\Report\Entity\AlgorithmParameter;
use App\Report\Entity\SummaryReport;
use Box\Spout\Writer\Common\Creator\WriterEntityFactory;
use File;
use Symfony\Component\HttpFoundation\File\UploadedFile;

final class Handler
{
    public function __construct(
        private readonly ClaimRepository $claims,
    )
    {
    }

    public function handle(SummaryReport $report): void
    {
        $p = $report->confidence_probability;

        $companyId = $report->company?->id;

        $typeIds = $report->types?->map(function (CarriageType $type) {
            return $type->id;
        });

        $seriesIds = $report->series?->map(function (CarriageSeries $series) {
            return $series->id;
        });

        if ($products = $report->products) {
            $fileDir = storage_path() . '/reports/summary';

            if(!File::exists($fileDir)) {
                File::makeDirectory($fileDir, recursive: true);
            }

            $fileName = $report->name . '.xlsx';
            $filePath = $fileDir . '/' . $report->id . '.xlsx';

            $writer = WriterEntityFactory::createXLSXWriter()
                ->openToFile($filePath);

            $writer->addRow(WriterEntityFactory::createRow([
                WriterEntityFactory::createCell('Индекс'),
                WriterEntityFactory::createCell('Наименование'),
                WriterEntityFactory::createCell('Количество отказов'),
                WriterEntityFactory::createCell('Наработка'),
                WriterEntityFactory::createCell('Точечная интенсивность'),
                WriterEntityFactory::createCell('Верхняя граница интенсивности')
            ]));

            foreach ($products as $product) {
                /** @var Product $product */

                $sumOperating = 0;

                if ($product->series) {
                    foreach ($product->series as $productSeries) {
                        /** @var CarriageSeries $productSeries */

                        if ($operatingList = $productSeries->operating) {
                            foreach ($operatingList as $operating) {
                                /** @var OperatingTime $operating */

                                if ($operating->date >= $report->period_from_date && $operating->date <= $report->period_to_date) {
                                    $sumOperating += ($operating->mileage * $productSeries->pivot->quantity * $operating->count_carriage);
                                }
                            }
                        }
                    }
                }

                if ((!$d = $this->claims->countByProductIdCompanyIdTypesIdSeriesId($product->id, $companyId,
                        $typeIds->toArray(), $seriesIds->toArray()))
                    || ($sumOperating == 0)) {
                    continue;
                }

                $pointFailureRate = $d / $sumOperating;

                $x = AlgorithmParameter::getX(
                    (2 * $d + 2),
                    $p
                );

                $topPointFailureRate = ($pointFailureRate * ($x)) / 2 * $d;

                $writer->addRow(WriterEntityFactory::createRow([
                    WriterEntityFactory::createCell($product->article),
                    WriterEntityFactory::createCell($product->name),
                    WriterEntityFactory::createCell($d),
                    WriterEntityFactory::createCell($sumOperating),
                    WriterEntityFactory::createCell($pointFailureRate),
                    WriterEntityFactory::createCell($topPointFailureRate)
                ]));
            }

            $writer->close();

            $report->addMedia(new UploadedFile(
                $filePath,
                $fileName,
                mime_content_type($filePath),
                filesize($filePath),
                0,
            ))
                ->toMediaCollection(SummaryReport::MEDIA_COLLECTION);
        }
    }
}
