<?php

namespace App\Nova\Catalog\Resources;

use App\Catalog\Entity\OrderLine;
use App\Nova\Product\Resources\ProductNova;
use App\Nova\Resource;
use Eminiarts\Tabs\Traits\HasTabs;
use Illuminate\Http\Request;
use Laravel\Nova\Fields;
use Laravel\Nova\Http\Requests\NovaRequest;

class OrderLineNova extends Resource
{
    use HasTabs;

    public static $model = OrderLine::class;

    public static $displayInNavigation = false;

    public function fields(NovaRequest $request)
    {
        return [
            Fields\BelongsTo::make('Изделие', 'product', ProductNova::class),

            Fields\Text::make('Количество', 'quantity'),
        ];
    }

    public static function authorizedToCreate(Request $request)
    {
        return false;
    }

    public function authorizedToDelete(Request $request)
    {
        return false;
    }

    public function authorizedToUpdate(Request $request)
    {
        return false;
    }

    public function authorizedToReplicate(Request $request)
    {
        return false;
    }

    public function authorizedToView(Request $request)
    {
        return false;
    }
}
