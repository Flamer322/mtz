<?php

namespace App\Nova\Dictionary\Resources;

use App\Dictionary\Entity\Category;
use App\Nova\Resource;
use Ebess\AdvancedNovaMediaLibrary\Fields\Images;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Carbon;
use Laravel\Nova\Fields;
use Laravel\Nova\Http\Requests\NovaRequest;

class CategoryNova extends Resource
{
    public static $model = Category::class;

    public static $title = 'name';

    public static $group = 'Словари';

    public static function label()
    {
        return 'Категории';
    }

    public static function singularLabel()
    {
        return 'Категория';
    }

    public static $search = [
        'name',
    ];

    public function fields(NovaRequest $request)
    {
        return [
            Fields\ID::make()->sortable(),

            Images::make('Изображение', Category::MEDIA_COLLECTION)
                ->conversionOnDetailView('preview')
                ->temporary(Carbon::now()->addMinutes(10)),

            Fields\Text::make('Название', 'name')
                ->sortable()
                ->rules('required', 'max:255'),

            Fields\Text::make('Cлаг', 'slug')
                ->rules('required', 'max:255'),

            Fields\BelongsTo::make('Родительская категория', 'parent', CategoryNova::class)
                ->nullable(),

            Fields\Textarea::make('Описание', 'description'),
        ];
    }

    public static function relatableCategories(NovaRequest $request, $query): Builder
    {
        $resourceId = $request->get('resourceId');
            return $query->where('id', '!=', $resourceId);
    }
}
