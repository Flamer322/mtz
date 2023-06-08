<?php

namespace App\Nova\Report\Actions;

use App\Report\Command\Reliability\Calculate;
use Exception;
use Illuminate\Support\Facades\DB;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Fields\ActionFields;

class CalculateReliabilityAction extends Action
{
    public $name = 'Рассчитать безотказность';

    private Calculate\Handler $handler;

    public function label(): string
    {
        return 'Рассчитать безотказность';
    }

    public function __construct()
    {
        $this->handler = app(Calculate\Handler::class);
    }

    public function handle(ActionFields $fields): array
    {
        try {
            DB::commit();

            $this->handler->handle();

            return Action::message('Безотказность рассчитана');
        } catch (Exception $e) {
            return Action::danger($e->getMessage());
        }
    }
}
