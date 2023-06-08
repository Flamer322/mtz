<?php

namespace App\Nova\Report\Resources;

use App\Nova\Product\Resources\ProductNova;
use App\Nova\Report\Actions\CalculateReliabilityAction;
use App\Nova\Resource;
use App\Report\Entity\Reliability;
use Laravel\Nova\Actions\ExportAsCsv;
use Laravel\Nova\Fields;
use Laravel\Nova\Http\Requests\NovaRequest;

class ReliabilityNova extends Resource
{
    public static $model = Reliability::class;

    public function title()
    {
        return $this->product->article . ' | ' . $this->product->name;
    }

    public static $group = 'Отчёты';

    public static function label()
    {
        return 'Безотказность';
    }

    public static function singularLabel()
    {
        return 'Безотказность';
    }

    public function actions(NovaRequest $request)
    {
        return [
            CalculateReliabilityAction::make()
                ->standalone()
                ->onlyOnIndex()
                ->confirmButtonText('Рассчитать'),

            ExportAsCsv::make()
                ->withMeta([
                    'name' => 'Экспортировать в CSV'
                ])
                ->withFormat(function (Reliability $model) {
                    return [
                        'Индекс' => $model->product->article,
                        'Наименование' => $model->product->name,
                        'Средняя наработка на отказ' => $model->product->detail?->average_failure_time,
                        'Количество отказов' => $model->failure_number,
                        'Наработка' => $model->total_operating,
                        'Точечная интенсивность' => $model->point_rate,
                        'Верхняя граница интенсивности' => $model->top_rate,
                    ];
                })
                ->confirmButtonText('Экспортировать'),
        ];
    }

    public function fields(NovaRequest $request)
    {
        return [
            Fields\ID::make()
                ->sortable(),

            Fields\BelongsTo::make('Продукция', 'product', ProductNova::class)
                ->sortable(),

            Fields\Number::make('Отказы', 'failure_number')
                ->sortable(),

            Fields\Number::make('Наработка', 'total_operating')
                ->sortable(),

            Fields\Number::make('Точечная интенсивность', 'point_rate')
                ->sortable(),

            Fields\Number::make('Верхняя граница интенсивности', 'top_rate')
                ->sortable(),
        ];
    }
}
