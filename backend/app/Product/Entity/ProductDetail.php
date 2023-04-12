<?php

namespace App\Product\Entity;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

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
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|ProductDetail newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductDetail newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductDetail onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductDetail query()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductDetail whereAverageFailureTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductDetail whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductDetail whereDimension($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductDetail whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductDetail whereOkp($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductDetail whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductDetail whereReferenceDocument($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductDetail whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductDetail whereWeight($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductDetail withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductDetail withoutTrashed()
 * @mixin \Eloquent
 */
class ProductDetail extends Model
{
    use SoftDeletes;
}
