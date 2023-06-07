<?php

namespace App\Nova\Product\Resources;

use App\Nova\Resource;
use App\Product\Entity\Image;
use Ebess\AdvancedNovaMediaLibrary\Fields\Images;
use Eminiarts\Tabs\Traits\HasTabs;
use Eminiarts\Tabs;
use Illuminate\Support\Carbon;
use Laravel\Nova\Fields;
use Laravel\Nova\Http\Requests\NovaRequest;

class ImageNova extends Resource
{
    use HasTabs;

    public static $model = Image::class;

    public static $title = 'name';

    public static $group = 'Продукция';

    public static function label()
    {
        return 'Изображения';
    }

    public static function singularLabel()
    {
        return 'Изображение';
    }

    public static $search = [
        'name',
    ];

    public function fields(NovaRequest $request)
    {
        return [
            Tabs\Tabs::make('Изображение', [
                Tabs\Tab::make('Основная информация', [
                    Fields\ID::make()->sortable(),

                    Images::make('Изображение', Image::MEDIA_COLLECTION)
                        ->temporary(Carbon::now()->addMinutes(10))
                        ->required(),

                    Fields\Text::make('Название', 'name')
                        ->rules('required', 'max:255')
                        ->sortable(),

                    Fields\Textarea::make('Описание', 'alt')
                        ->rules('max:255'),

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
