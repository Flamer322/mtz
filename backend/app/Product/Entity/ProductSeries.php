<?php

namespace App\Product\Entity;

use App\Dictionary\Entity\CarriageSeries;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\Pivot;

/**
 * App\Product\Entity\ProductSeries
 *
 * @property int $product_id
 * @property int $series_id
 * @property int $quantity
 * @property-read \App\Product\Entity\Product $product
 * @property-read CarriageSeries $series
 * @method static \Illuminate\Database\Eloquent\Builder|ProductSeries newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductSeries newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductSeries query()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductSeries whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductSeries whereQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductSeries whereSeriesId($value)
 * @mixin \Eloquent
 */
final class ProductSeries extends Pivot
{
    public $timestamps = false;

    protected $fillable = [
        'quantity',
    ];

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function series(): BelongsTo
    {
        return $this->belongsTo(CarriageSeries::class, 'series_id');
    }
}
