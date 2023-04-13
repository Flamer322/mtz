<?php

namespace App\Product\Entity;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Product\Entity\ProductDetail
 *
 * @property int $id
 * @property int $product_id
 * @property string|null $okp
 * @property string|null $reference_document
 * @property string|null $dimension
 * @property string|null $weight
 * @property float|null $average_failure_time
 * @property-read \App\Product\Entity\Product $product
 * @method static \Illuminate\Database\Eloquent\Builder|ProductDetail newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductDetail newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductDetail query()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductDetail whereAverageFailureTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductDetail whereDimension($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductDetail whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductDetail whereOkp($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductDetail whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductDetail whereReferenceDocument($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductDetail whereWeight($value)
 * @mixin \Eloquent
 */
class ProductDetail extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'okp',
        'reference_document',
        'dimension',
        'weight',
        'average_failure_time',
    ];

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
