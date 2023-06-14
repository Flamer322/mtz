<?php

namespace App\Nova\Report\Resources;

use App\Nova\Product\Resources\ProductNova;
use App\Nova\Report\Actions\GenerateExplanatoryNoteAction;
use App\Nova\Resource;
use App\Nova\User\Resources\UserNova;
use App\Report\Entity\ExplanatoryNote;
use Ebess\AdvancedNovaMediaLibrary\Fields\Files;
use Illuminate\Support\Carbon;
use Laravel\Nova\Fields;
use Laravel\Nova\Http\Requests\NovaRequest;

class ExplanatoryNoteNova extends Resource
{
    public static $model = ExplanatoryNote::class;

    public static $title = 'name';

    public static $group = 'Отчёты';

    public static function label()
    {
        return 'Пояснительные записки';
    }

    public static function singularLabel()
    {
        return 'Пояснительная записка';
    }

    public static $search = [
        'name',
    ];

    public function actions(NovaRequest $request)
    {
        return [
            GenerateExplanatoryNoteAction::make()
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

            Files::make('Файл', ExplanatoryNote::MEDIA_COLLECTION)
                ->temporary(Carbon::now()->addMinutes(10))
                ->hideWhenCreating()
                ->hideWhenUpdating(),

            Fields\BelongsTo::make('Изделие', 'product', ProductNova::class),

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
