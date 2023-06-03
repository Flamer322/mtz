<?php

namespace App\Nova\Product\Resources;

use App\Nova\Dictionary\Resources\CategoryNova;
use App\Nova\Dictionary\Resources\StatusNova;
use App\Nova\Resource;
use App\Product\Entity\Product;
use Ebess\AdvancedNovaMediaLibrary\Fields\Images;
use Eminiarts\Tabs\Traits\HasTabs;
use Eminiarts\Tabs;
use Illuminate\Support\Carbon;
use Laravel\Nova\Fields;
use Laravel\Nova\Http\Requests\NovaRequest;

class ProductNova extends Resource
{
    use HasTabs;

    public static $model = Product::class;

    public function title()
    {
        return $this->article . ' | ' . $this->name;
    }

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
            Tabs\Tabs::make('Изделие', [
                Tabs\Tab::make('Основная информация', [
                    Fields\ID::make()
                        ->sortable(),

                    Images::make('Изображение', Product::MEDIA_COLLECTION)
                        ->temporary(Carbon::now()->addMinutes(10)),

                    Fields\Text::make('Индекс', 'article')
                        ->rules('max:255', 'required')
                        ->creationRules('unique:products,article,NULL,id,deleted_at,NULL')
                        ->updateRules('unique:products,article,{{resourceId}},id,deleted_at,NULL')
                        ->sortable(),

                    Fields\Text::make('Наименование', 'name')
                        ->rules('required', 'max:255')
                        ->sortable(),

                    Fields\Text::make('Cлаг', 'slug')
                        ->hideWhenCreating()
                        ->hideWhenUpdating(),

                    Fields\BelongsTo::make('Статус', 'status', StatusNova::class),

                    Fields\Textarea::make('Описание', 'description'),

                    Fields\Boolean::make('Запасная часть', 'is_spare_part'),

                    Fields\DateTime::make('Создано', 'created_at')
                        ->hideWhenCreating()
                        ->hideWhenUpdating(),

                    Fields\DateTime::make('Обновлено', 'updated_at')
                        ->hideWhenCreating()
                        ->hideWhenUpdating(),

                    Fields\BelongsToMany::make('Категории', 'categories', CategoryNova::class)
                        ->asPanel(),
                ]),

                Fields\HasOne::make('Детальная информация', 'detail', ProductDetailNova::class),
                Fields\HasMany::make('Дополнительные поля', 'fields', ProductAdditionalFieldNova::class),
                Fields\BelongsToMany::make('Изображения', 'images', ImageNova::class),
                Fields\BelongsToMany::make('Файлы', 'files', FileNova::class),
                Fields\BelongsToMany::make('Запасные части', 'spare_parts', ProductNova::class),
                Fields\BelongsToMany::make('Аналоги', 'modifications', ProductNova::class),
            ])->withToolbar(),
        ];
    }
}
