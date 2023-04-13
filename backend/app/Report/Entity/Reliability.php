<?php

namespace App\Report\Entity;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Report\Entity\Reliability
 *
 * @property int $id
 * @property int $product_id
 * @property int $failure_number
 * @property int $total_operating
 * @property float $point_rate
 * @property float $top_rate
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
}
