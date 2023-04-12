<?php

namespace App\Product\Entity;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Product\Entity\ProductAdditionalField
 *
 * @property int $id
 * @property int $product_id
 * @property string|null $name
 * @property string $value
 * @property int $sort_order
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|ProductAdditionalField newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductAdditionalField newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductAdditionalField query()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductAdditionalField whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductAdditionalField whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductAdditionalField whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductAdditionalField whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductAdditionalField whereSortOrder($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductAdditionalField whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductAdditionalField whereValue($value)
 * @mixin \Eloquent
 */
class ProductAdditionalField extends Model
{
}
