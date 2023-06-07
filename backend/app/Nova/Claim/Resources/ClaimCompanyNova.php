<?php

namespace App\Nova\Claim\Resources;

use App\Claim\Entity\ClaimCompany;
use App\Nova\Resource;
use Laravel\Nova\Fields;
use Laravel\Nova\Http\Requests\NovaRequest;

class ClaimCompanyNova extends Resource
{
    public static $model = ClaimCompany::class;

    public static $title = 'full_name';

    public static $group = 'Несоответствия';

    public static function label()
    {
        return 'Компании';
    }

    public static function singularLabel()
    {
        return 'Компания';
    }

    public static $search = [
        'short_name', 'full_name',
    ];

    public function fields(NovaRequest $request)
    {
        return [
            Fields\ID::make()
                ->sortable(),

            Fields\Text::make('Полное название', 'full_name')
                ->rules('required', 'max:255')
                ->sortable(),

            Fields\Text::make('Краткое название', 'short_name')
                ->rules('required', 'max:255')
                ->sortable(),
        ];
    }
}
