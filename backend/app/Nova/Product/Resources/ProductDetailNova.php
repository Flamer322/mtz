<?php

namespace App\Nova\Product\Resources;

use App\Nova\Resource;
use App\Product\Entity\ProductDetail;
use Illuminate\Http\Request;
use Laravel\Nova\Fields;
use Laravel\Nova\Http\Requests\NovaRequest;

class ProductDetailNova extends Resource
{
    public static $model = ProductDetail::class;

    public static $title = 'name';

    public static $group = 'Продукция';

    public static $displayInNavigation = false;

    public static function label()
    {
        return 'Детальная информация';
    }

    public static function singularLabel()
    {
        return 'Детальная информация';
    }

    public function fields(NovaRequest $request)
    {
        return [
            Fields\Text::make('ОКП', 'okp')
                ->rules('max:255'),

            Fields\Text::make('Ссылочный документ', 'reference_document')
                ->rules('max:255'),

            Fields\Text::make('Габаритные размеры, мм, не более', 'dimension')
                ->rules('max:255'),

            Fields\Text::make('Масса, кг, не более', 'weight')
                ->rules('max:255'),

            Fields\Number::make('Средняя наработка на отказ', 'average_failure_time')
                ->rules('nullable', 'numeric', 'gt:0'),
        ];
    }

    public function authorizedToDelete(Request $request)
    {
        return false;
    }

    public function authorizedToReplicate(Request $request)
    {
        return false;
    }
}
