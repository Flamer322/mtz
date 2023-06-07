<?php

namespace App\Nova\Product\Resources;

use App\Nova\Resource;
use App\Product\Entity\File;
use Ebess\AdvancedNovaMediaLibrary\Fields\Files;
use Eminiarts\Tabs\Traits\HasTabs;
use Eminiarts\Tabs;
use Illuminate\Support\Carbon;
use Laravel\Nova\Fields;
use Laravel\Nova\Http\Requests\NovaRequest;

class FileNova extends Resource
{
    use HasTabs;

    public static $model = File::class;

    public static $title = 'name';

    public static $group = 'Продукция';

    public static function label()
    {
        return 'Файлы';
    }

    public static function singularLabel()
    {
        return 'Файл';
    }

    public static $search = [
        'name',
    ];

    public function fields(NovaRequest $request)
    {
        return [
            Tabs\Tabs::make('Файл', [
                Tabs\Tab::make('Основная информация', [
                    Fields\ID::make()->sortable(),

                    Fields\Text::make('Иконка', static fn (File $file)
                        => '<img src="' . $file->getFileExtensionPreview() . '" width=32px>')
                        ->asHtml()
                        ->hideWhenCreating()
                        ->hideWhenUpdating(),

                    Files::make('Файл', File::MEDIA_COLLECTION)
                        ->temporary(Carbon::now()->addMinutes(10))
                        ->required(),

                    Fields\Text::make('Название', 'name')
                        ->rules('required', 'max:255')
                        ->sortable(),

                    Fields\Select::make('Тип', 'type')
                        ->options(File::FILE_TYPES)
                        ->displayUsing(static fn ($type) => File::FILE_TYPES[$type])
                        ->rules('required'),

                    Fields\DateTime::make('Создано', 'created_at')
                        ->hideWhenCreating()
                        ->hideWhenUpdating(),

                    Fields\DateTime::make('Обновлено', 'updated_at')
                        ->hideWhenCreating()
                        ->hideWhenUpdating(),
                ]),

                Fields\BelongsToMany::make('Продукция', 'products', ProductNova::class),
            ])->withToolbar(),
        ];
    }
}
