<?php

namespace App\Report\Command\ExplanatoryNote\Generate;

use App\Claim\Entity\OperatingTime;
use App\Claim\Repository\ClaimRepository;
use App\Dictionary\Entity\CarriageSeries;
use App\Report\Entity\AlgorithmParameter;
use App\Report\Entity\ExplanatoryNote;
use App\Report\Entity\NoteTemplate;
use File;
use PhpOffice\PhpWord\TemplateProcessor;
use Symfony\Component\HttpFoundation\File\UploadedFile;

final class Handler
{
    public function __construct(
        private readonly ClaimRepository $claims,
    )
    {
    }

    public function handle(ExplanatoryNote $note): void
    {
        $p = $note->confidence_probability;

        $fileDir = storage_path() . NoteTemplate::DIRS[NoteTemplate::EXPLANATORY];

        if(!File::exists($fileDir)) {
            File::makeDirectory($fileDir, recursive: true);
        }

        $fileName = $note->name . '.docx';
        $filePath = $fileDir . '/' . $note->id . '.docx';

        if (!File::exists(storage_path() . NoteTemplate::DIRS[NoteTemplate::EXPLANATORY])) {
            File::makeDirectory(storage_path() . NoteTemplate::DIRS[NoteTemplate::EXPLANATORY], recursive: true);
        }

        if (!File::exists(storage_path() . NoteTemplate::DIRS[NoteTemplate::EXPLANATORY] . '/template.docx')) {
            $phpWord = new \PhpOffice\PhpWord\PhpWord();

            $section = $phpWord->addSection();

            $section->addText('Шаблон не найден', array('name' => 'Times New Roman', 'size' => 14));

            $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');

            $objWriter->save($filePath);

            return;
        }

        $templateProcessor = new TemplateProcessor(storage_path() . NoteTemplate::DIRS[NoteTemplate::EXPLANATORY] . '/template.docx');

        $totalOperating = 0;

        $product = $note->product;

        if ($product->series) {
            foreach ($product->series as $productSeries) {
                /** @var CarriageSeries $productSeries */

                if ($operatingList = $productSeries->operating) {
                    foreach ($operatingList as $operating) {
                        /** @var OperatingTime $operating */

                        if ($operating->date >= $note->period_from_date && $operating->date <= $note->period_to_date) {
                            $totalOperating += ($operating->mileage * $productSeries->pivot->quantity * $operating->count_carriage);
                        }
                    }
                }
            }
        }

        $d = $this->claims->countByProductId($product->id);

        if ($totalOperating != 0) {
            $pointRate = $d / $totalOperating;
        } else {
            $pointRate = '"Невозможно посчитать: нулевая наработка"';
        }

        $confidenceProbability = AlgorithmParameter::getX(
            (2 * $d + 2),
            $p
        );

        $marginalRelativeError = 1 / $confidenceProbability;

        if ($totalOperating != 0) {
            $topRate = ($pointRate * ($confidenceProbability)) / 2 * $d;
        } else {
            $topRate = '"Невозможно посчитать: нулевая наработка"';
        }

        $templateProcessor->setValues([
            'productName' => $product->name,
            'productArticle' => $product->article,
            'confidenceProbability' => $confidenceProbability,
            'marginalRelativeError' => $marginalRelativeError,
            'period' => "{$note->period_from_date->format('d.m.Y')} - {$note->period_to_date->format('d.m.Y')}",
            'averageFailureTime' => $product->detail?->average_failure_time,
            'totalOperating' => $totalOperating,
            'pointRate' => $pointRate,
            'topRate' => $topRate
        ]);

        $templateProcessor->saveAs($filePath);

        $note->addMedia(new UploadedFile(
                $filePath,
                $fileName,
                mime_content_type($filePath),
                filesize($filePath),
                0,
            ))
            ->toMediaCollection(ExplanatoryNote::MEDIA_COLLECTION);
    }
}
