<?php

namespace App\Nova\Catalog\Resources;

use App\Catalog\Entity\OrderLine;
use App\Nova\Product\Resources\ProductNova;
use App\Nova\Resource;
use App\Product\Entity\Product;
use Eminiarts\Tabs\Traits\HasTabs;
use Illuminate\Http\Request;
use Laravel\Nova\Fields;
use Laravel\Nova\Http\Requests\NovaRequest;

class OrderLineNova extends Resource
{
    use HasTabs;

    public static $model = OrderLine::class;

    public static $displayInNavigation = false;

    public static $search = [
        'product.name', 'product.article',
    ];

    public function fields(NovaRequest $request)
    {
        return [
            Fields\BelongsTo::make('Изделие', 'product', ProductNova::class),

            Fields\Text::make('Статус изделия', 'product', static fn (Product $product) => '
                    <span style="color: white; background-color: ' . $product->status->color .'" class="inline-flex items-center
                    whitespace-nowrap min-h-6 px-2 rounded-full uppercase text-xs font-bold">'. $product->status->name . '</span>')
                ->asHtml(),

            Fields\Text::make('Количество', 'quantity'),
        ];
    }

    public function authorizedToView(Request $request)
    {
        return false;
    }
}
