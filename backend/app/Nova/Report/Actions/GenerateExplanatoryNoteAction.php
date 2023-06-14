<?php

namespace App\Nova\Report\Actions;

use App\Report\Command\ExplanatoryNote\Generate;
use Exception;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Fields\ActionFields;

class GenerateExplanatoryNoteAction extends Action
{
    public $name = 'Сгенерировать пояснительную записку';

    private Generate\Handler $handler;

    public function label(): string
    {
        return 'Сгенерировать пояснительную записку';
    }

    public function __construct()
    {
        $this->handler = app(Generate\Handler::class);
    }

    public function handle(ActionFields $fields, Collection $models): array
    {
        try {
            DB::commit();

            $this->handler->handle($models[0]);

            return Action::message('Записка сгенерирована');
        } catch (Exception $e) {
            return Action::danger($e->getMessage());
        }
    }
}
