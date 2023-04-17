<?php

namespace App\Nova\Dictionary\Resources;

use App\Dictionary\Entity\CarriageSeries;
use App\Nova\Resource;
use Laravel\Nova\Fields;
use Laravel\Nova\Http\Requests\NovaRequest;

class CarriageSeriesNova extends Resource
{
    public static $model = CarriageSeries::class;

    public static $title = 'name';

    public static $group = 'Словари';

    public static function label()
    {
        return 'Серии составов';
    }

    public static function singularLabel()
    {
        return 'Серия составов';
    }

    public static $search = [
        'name',
    ];

    public function fields(NovaRequest $request)
    {
        return [
            Fields\ID::make()->sortable(),

            Fields\BelongsTo::make('Тип', 'type', CarriageTypeNova::class)
                ->rules('required'),

            Fields\Text::make('Название', 'name')
                ->sortable()
                ->rules('required', 'max:255'),
        ];
    }
}
