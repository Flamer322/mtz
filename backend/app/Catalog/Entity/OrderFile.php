<?php

namespace App\Catalog\Entity;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Catalog\Entity\OrderFile
 *
 * @property int $id
 * @property int $order_id
 * @property string $file
 * @property string|null $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|OrderFile newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|OrderFile newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|OrderFile query()
 * @method static \Illuminate\Database\Eloquent\Builder|OrderFile whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderFile whereFile($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderFile whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderFile whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderFile whereOrderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderFile whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class OrderFile extends Model
{
}
