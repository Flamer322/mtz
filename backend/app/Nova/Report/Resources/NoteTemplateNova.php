<?php

namespace App\Nova\Report\Resources;

use App\Nova\Resource;
use App\Report\Entity\NoteTemplate;
use Laravel\Nova\Fields;
use Laravel\Nova\Http\Requests\NovaRequest;

class NoteTemplateNova extends Resource
{
    public static $model = NoteTemplate::class;

    public static $title = 'type';

    public static $group = 'Отчёты';

    public static function label()
    {
        return 'Шаблоны записок';
    }

    public static function singularLabel()
    {
        return 'Шаблон записки';
    }

    public function fields(NovaRequest $request)
    {
        return [
            Fields\ID::make()
                ->sortable(),

            Fields\Select::make('Тип шаблона', 'type')
                ->options(NoteTemplate::VALUES)
                ->displayUsing(static fn ($type) => NoteTemplate::VALUES[$type])
                ->rules('required')
                ->sortable(),

            Fields\File::make('Шаблон', 'file')
                ->disk('local')
                ->rules('required')
                ->onlyOnForms(),
        ];
    }
}
