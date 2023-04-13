<?php

namespace App\Claim\Entity;

use App\Product\Entity\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Claim\Entity\ProductNode
 *
 * @property int $id
 * @property int $product_id
 * @property string $name
 * @property-read Product $product
 * @method static \Illuminate\Database\Eloquent\Builder|ProductNode newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductNode newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductNode query()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductNode whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductNode whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductNode whereProductId($value)
 * @mixin \Eloquent
 */
class ProductNode extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'name',
    ];

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
