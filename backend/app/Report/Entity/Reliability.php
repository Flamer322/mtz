<?php

namespace App\Report\Entity;

use App\Product\Entity\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Report\Entity\Reliability
 *
 * @property int $id
 * @property int $product_id
 * @property int $failure_number
 * @property int $total_operating
 * @property float $point_rate
 * @property float $top_rate
 * @property-read Product $product
 * @method static \Illuminate\Database\Eloquent\Builder|Reliability newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Reliability newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Reliability query()
 * @method static \Illuminate\Database\Eloquent\Builder|Reliability whereFailureNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Reliability whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Reliability wherePointRate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Reliability whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Reliability whereTopRate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Reliability whereTotalOperating($value)
 * @mixin \Eloquent
 */
class Reliability extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'failure_number',
        'total_operating',
        'point_rate',
        'top_rate',
    ];

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
