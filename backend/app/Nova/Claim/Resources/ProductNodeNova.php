<?php

namespace App\Nova\Claim\Resources;

use App\Claim\Entity\ProductNode;
use App\Nova\Product\Resources\ProductNova;
use App\Nova\Resource;
use Laravel\Nova\Fields;
use Laravel\Nova\Http\Requests\NovaRequest;

class ProductNodeNova extends Resource
{
    public static $model = ProductNode::class;

    public function title()
    {
        return $this->article . ' | ' . $this->name;
    }

    public static $group = 'Несоответствия';

    public static function label()
    {
        return 'Узлы изделий';
    }

    public static function singularLabel()
    {
        return 'Узел изделия';
    }

    public static $search = [
        'name', 'article',
    ];

    public function fields(NovaRequest $request)
    {
        return [
            Fields\ID::make()
                ->sortable(),

            Fields\BelongsTo::make('Изделие (продукция)', 'product', ProductNova::class)
                ->rules('required'),

            Fields\Text::make('Индекс', 'article')
                ->rules('max:255', 'required')
                ->creationRules('unique:product_nodes,article,NULL,id')
                ->updateRules('unique:product_nodes,article,{{resourceId}},id')
                ->sortable(),

            Fields\Text::make('Наименование', 'name')
                ->rules('required', 'max:255')
                ->sortable(),
        ];
    }
}
