<?php

namespace App\Claim\Entity;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Claim\Entity\ProductNode
 *
 * @property int $id
 * @property int $product_id
 * @property string $name
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
}
