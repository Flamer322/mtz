<?php

namespace App\Nova\Report\Actions;

use App\Report\Command\SummaryReport\Generate;
use Exception;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Fields\ActionFields;

class GenerateSummaryReportAction extends Action
{
    public $name = 'Сгенерировать сводный отчёт';

    private Generate\Handler $handler;

    public function label(): string
    {
        return 'Сгенерировать сводный отчёт';
    }

    public function __construct()
    {
        $this->handler = app(Generate\Handler::class);
    }

    public function handle(ActionFields $fields, Collection $models): array
    {
        if ($models[0]->products->isEmpty()) {
            return Action::danger('Добавьте хотя бы одно изделие');
        }

        try {
            DB::commit();

            $this->handler->handle($models[0]);

            return Action::message('Отчёт сгенерирован');
        } catch (Exception $e) {
            return Action::danger($e->getMessage());
        }
    }
}
