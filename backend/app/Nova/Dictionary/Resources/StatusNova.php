<?php

namespace App\Nova\Dictionary\Resources;

use App\Dictionary\Entity\Status;
use App\Nova\Resource;
use Laravel\Nova\Fields;
use Laravel\Nova\Http\Requests\NovaRequest;

class StatusNova extends Resource
{
    public static $model = Status::class;

    public static $title = 'name';

    public static $group = 'Словари';

    public static function label()
    {
        return 'Статусы продукции';
    }

    public static function singularLabel()
    {
        return 'Статус продукции';
    }

    public static $search = [
        'name',
    ];

    public function fields(NovaRequest $request)
    {
        return [
            Fields\ID::make()
                ->sortable(),

            Fields\Text::make('Название', 'name')
                ->rules('required', 'max:255')
                ->sortable(),

            Fields\Color::make('Цвет', 'color')
                ->rules('required'),
        ];
    }
}
