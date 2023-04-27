<?php

namespace App\Nova\Product\Resources;

use App\Nova\Dictionary\Resources\StatusNova;
use App\Nova\Resource;
use App\Product\Entity\Product;
use Ebess\AdvancedNovaMediaLibrary\Fields\Images;
use Eminiarts\Tabs\Traits\HasTabs;
use Eminiarts\Tabs;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Laravel\Nova\Fields;
use Laravel\Nova\Http\Requests\NovaRequest;

class ProductNova extends Resource
{
    use HasTabs;

    public static $model = Product::class;

    public static $title = 'name';

    public static $group = 'Продукция';

    public static function label()
    {
        return 'Продукция';
    }

    public static function singularLabel()
    {
        return 'Изделие';
    }

    public static $search = [
        'name',
    ];

    public function fields(NovaRequest $request)
    {
        return [
            Tabs\Tabs::make('Some Title', [
                Tabs\Tab::make('Основная информация', [
                    Fields\ID::make()
                        ->sortable(),

                    Images::make('Изображение', Product::MEDIA_COLLECTION)
                        ->conversionOnDetailView('preview')
                        ->temporary(Carbon::now()->addMinutes(10)),

                    Fields\Text::make('Индекс', 'article')
                        ->sortable()
                        ->creationRules('max:255', 'required', 'unique:products,article,NULL,id,deleted_at,NULL')
                        ->updateRules('max:255', 'required',
                            'unique:products,article,' . $request->route('resourceId') . ',id,deleted_at,NULL'),

                    Fields\Text::make('Наименование', 'name')
                        ->sortable()
                        ->rules('required', 'max:255'),

                    Fields\BelongsTo::make('Статус', 'status', StatusNova::class),

                    Fields\Textarea::make('Описание', 'description'),

                    Fields\Boolean::make('Запасная часть', 'is_spare_part'),

                    Fields\DateTime::make('Создано', 'created_at')
                        ->hideWhenCreating()
                        ->hideWhenUpdating(),

                    Fields\DateTime::make('Обновлено', 'updated_at')
                        ->hideWhenCreating()
                        ->hideWhenUpdating(),
                ]),

                Fields\HasOne::make('Детальная информация', 'detail', ProductDetailNova::class),
                Fields\HasMany::make('Дополнительные поля', 'fields', ProductAdditionalFieldNova::class),
                Fields\BelongsToMany::make('Изображения', 'images', ImageNova::class),
            ]),
        ];
    }
}
