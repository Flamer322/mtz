<?php

namespace App\Nova\Dictionary\Resources;

use App\Dictionary\Entity\CarriageType;
use App\Nova\Resource;
use Laravel\Nova\Fields;
use Laravel\Nova\Http\Requests\NovaRequest;

class CarriageTypeNova extends Resource
{
    public static $model = CarriageType::class;

    public static $title = 'name';

    public static $group = 'Словари';

    public static function label()
    {
        return 'Типы составов';
    }

    public static function singularLabel()
    {
        return 'Тип составов';
    }

    public static $search = [
        'name',
    ];

    public function fields(NovaRequest $request)
    {
        return [
            Fields\ID::make()->sortable(),

            Fields\Text::make('Название', 'name')
                ->sortable()
                ->rules('required', 'max:255'),
        ];
    }
}
