<?php

namespace App\Nova\Report\Resources;

use App\Nova\Claim\Resources\ClaimCompanyNova;
use App\Nova\Dictionary\Resources\CarriageSeriesNova;
use App\Nova\Dictionary\Resources\CarriageTypeNova;
use App\Nova\Product\Resources\ProductNova;
use App\Nova\Report\Actions\GenerateSummaryReportAction;
use App\Nova\Resource;
use App\Nova\User\Resources\UserNova;
use App\Report\Entity\SummaryReport;
use Ebess\AdvancedNovaMediaLibrary\Fields\Files;
use Illuminate\Support\Carbon;
use Laravel\Nova\Fields;
use Laravel\Nova\Http\Requests\NovaRequest;

class SummaryReportNova extends Resource
{
    public static $model = SummaryReport::class;

    public static $title = 'name';

    public static $group = 'Отчёты';

    public static function label()
    {
        return 'Сводные отчёты';
    }

    public static function singularLabel()
    {
        return 'Сводный отчёт';
    }

    public static $search = [
        'name',
    ];

    public function actions(NovaRequest $request)
    {
        return [
            GenerateSummaryReportAction::make()
                ->confirmButtonText('Сгенерировать')
                ->exceptOnIndex(),
        ];
    }

    public function fields(NovaRequest $request)
    {
        return [
            Fields\ID::make()
                ->sortable(),

            Fields\Text::make('Название', 'name')
                ->rules('required', 'max:255')
                ->sortable(),

            Fields\Select::make('Доверительная вероятность', 'confidence_probability')
                ->options([
                    0 => '0,1',
                    1 => '0,2',
                    2 => '0,8',
                    3 => '0,9',
                ])
                ->displayUsing(static fn ($probability) => [
                    0 => '0,1',
                    1 => '0,2',
                    2 => '0,8',
                    3 => '0,9',
                ][$probability])
                ->rules('required'),

            Fields\Date::make('Дата начала периода наблюдения', 'period_from_date')
                ->rules('required'),

            Fields\Date::make('Дата конца периода наблюдения', 'period_to_date')
                ->rules('required'),

            Files::make('Файл', SummaryReport::MEDIA_COLLECTION)
                ->temporary(Carbon::now()->addMinutes(10))
                ->hideWhenCreating()
                ->hideWhenUpdating(),

            Fields\BelongsTo::make('Компания', 'company', ClaimCompanyNova::class)
                ->nullable()
                ->hideFromIndex(),

            Fields\BelongsToMany::make('Продукция', 'products', ProductNova::class),

            Fields\BelongsToMany::make('Типы составов', 'types', CarriageTypeNova::class),

            Fields\BelongsToMany::make('Серии составов', 'series', CarriageSeriesNova::class),

//            BelongsToMany::make('Продукция', 'products', ProductNova::class)
//                ->rules('required')
//                ->onlyOnForms(),
//
//            Fields\Text::make('Продукция', 'products', static fn (Collection $products) => $products
//                ->map(static fn (Product $product) => $product->article . ' | ' . $product->name)->implode(', '))
//                ->hideWhenCreating()
//                ->hideWhenUpdating()
//                ->hideFromIndex(),
//
//            BelongsToMany::make('Типы составов', 'types', CarriageTypeNova::class)
//                ->onlyOnForms(),
//
//            Fields\Text::make('Типы составов', 'types', static fn (Collection $types) => $types
//                ->implode('name', ', '))
//                ->hideWhenCreating()
//                ->hideWhenUpdating()
//                ->hideFromIndex(),
//
//            BelongsToMany::make('Серии составов', 'series', CarriageSeriesNova::class)
//                ->onlyOnForms(),
//
//            Fields\Text::make('Серии составов', 'series', static fn (Collection $series) => $series
//                ->implode('name', ', '))
//                ->hideWhenCreating()
//                ->hideWhenUpdating()
//                ->hideFromIndex(),

            Fields\Hidden::make('Создатель', 'created_by')
                ->default(function ($request) {
                    return $request->user()->id;
                })
                ->hideFromIndex()
                ->hideFromDetail(),

            Fields\BelongsTo::make('Создатель', 'createdBy', UserNova::class)
                ->hideWhenCreating()
                ->hideWhenUpdating(),

            Fields\DateTime::make('Дата создания', 'created_at')
                ->hideWhenCreating()
                ->hideWhenUpdating(),
        ];
    }
}
