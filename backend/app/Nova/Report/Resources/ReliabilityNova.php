<?php

namespace App\Nova\Report\Resources;

use App\Dictionary\Entity\CarriageSeries;
use App\Nova\Dictionary\Resources\CarriageTypeNova;
use App\Nova\Product\Resources\ProductNova;
use App\Nova\Report\Actions\CalculateReliabilityAction;
use App\Nova\Resource;
use App\Report\Entity\Reliability;
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
            (new CalculateReliabilityAction)
                ->standalone()
                ->onlyOnIndex()
                ->confirmButtonText('Рассчитать'),
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
