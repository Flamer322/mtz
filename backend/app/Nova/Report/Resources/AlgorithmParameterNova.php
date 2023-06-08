<?php

namespace App\Nova\Report\Resources;

use App\Nova\Resource;
use App\Report\Entity\AlgorithmParameter;
use Laravel\Nova\Fields;
use Laravel\Nova\Http\Requests\NovaRequest;

class AlgorithmParameterNova extends Resource
{
    public static $model = AlgorithmParameter::class;

    public static $title = 'name';

    public static $group = 'Отчёты';

    public static function label()
    {
        return 'Параметры алгоритма';
    }

    public static function singularLabel()
    {
        return 'Параметр алгоритма';
    }

    public static $search = [
        'name', 'key',
    ];

    public function fields(NovaRequest $request)
    {
        return [
            Fields\ID::make()
                ->sortable(),

            Fields\Text::make('Название', 'name')
                ->rules('required', 'max:255')
                ->sortable(),

            Fields\Text::make('Ключ', 'key')
                ->rules('required', 'max:255')
                ->sortable(),

            Fields\Number::make('Значение', 'value')
                ->rules('required', 'numeric'),
        ];
    }
}
