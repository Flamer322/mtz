<?php

namespace App\Nova\Claim\Resources;

use App\Claim\Entity\DefectType;
use App\Claim\Entity\OperatingTime;
use App\Nova\Dictionary\Resources\CarriageSeriesNova;
use App\Nova\Resource;
use Laravel\Nova\Fields;
use Laravel\Nova\Http\Requests\NovaRequest;

class OperatingTimeNova extends Resource
{
    public static $model = OperatingTime::class;

    public static $title = 'name';

    public static $group = 'Несоответствия';

    public static function label()
    {
        return 'Время наработки';
    }

    public static function singularLabel()
    {
        return 'Время наработки';
    }

    public static $search = [
        'name',
    ];

    public function fields(NovaRequest $request)
    {
        return [
            Fields\ID::make()
                ->sortable(),

            Fields\BelongsTo::make('Серия', 'series', CarriageSeriesNova::class)
                ->rules('required'),

            Fields\Date::make('Дата наработки', 'date')
                ->rules('required')
                ->sortable(),

            Fields\Text::make('Наработка', static fn (OperatingTime $operatingTime) =>
                $operatingTime->mileage . ' ' . OperatingTime::UNIT_LIST[$operatingTime->unit])
                ->rules('required', 'numeric', 'min:0')
                ->hideWhenCreating()
                ->hideWhenUpdating(),

            Fields\Number::make('Наработка', 'mileage')
                ->rules('required', 'numeric', 'min:0')
                ->hideFromIndex()
                ->hideFromDetail(),

            Fields\Select::make('Единица измерения наработки', 'unit')
                ->options(OperatingTime::UNITS)
                ->rules('required')
                ->hideFromIndex()
                ->hideFromDetail(),

            Fields\Text::make('Количество единиц подвижного состава', 'count_carriage')
                ->rules('required', 'numeric', 'min:0'),

            Fields\Text::make('Примечание', 'note')
                ->rules('max:255')
                ->hideFromIndex(),
        ];
    }
}
