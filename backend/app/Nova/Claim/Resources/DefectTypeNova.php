<?php

namespace App\Nova\Claim\Resources;

use App\Claim\Entity\DefectType;
use App\Nova\Resource;
use Laravel\Nova\Fields;
use Laravel\Nova\Http\Requests\NovaRequest;

class DefectTypeNova extends Resource
{
    public static $model = DefectType::class;

    public static $title = 'name';

    public static $group = 'Несоответствия';

    public static function label()
    {
        return 'Типы несоответствий';
    }

    public static function singularLabel()
    {
        return 'Тип несоответствия';
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
        ];
    }
}
