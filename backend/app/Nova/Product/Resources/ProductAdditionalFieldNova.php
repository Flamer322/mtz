<?php

namespace App\Nova\Product\Resources;

use App\Nova\Resource;
use App\Product\Entity\ProductAdditionalField;
use Illuminate\Support\Str;
use Laravel\Nova\Fields;
use Laravel\Nova\Http\Requests\NovaRequest;

class ProductAdditionalFieldNova extends Resource
{
    public static $model = ProductAdditionalField::class;

    public static $title = 'name';

    public static $group = 'Продукция';

    public static $displayInNavigation = false;

    public static function label()
    {
        return 'Дополнительные поля';
    }

    public static function singularLabel()
    {
        return 'Дополнительное поле';
    }

    public function fields(NovaRequest $request)
    {
        return [
            Fields\Text::make('Название', 'name')
                ->rules('max:255', 'required'),

            Fields\Textarea::make('Значение', 'value'),

            Fields\Text::make('Значение', 'value')
                ->displayUsing(static fn ($text) => Str::limit($text, 30))
                ->hideWhenUpdating()
                ->hideWhenCreating(),

            Fields\Number::make('Порядок', 'sort_order')
                ->rules('required', 'integer', 'gt:0'),
        ];
    }
}
