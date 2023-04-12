<?php

namespace App\Dictionary\Entity;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Dictionary\Entity\CarriageType
 *
 * @property int $id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|CarriageType newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CarriageType newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CarriageType query()
 * @method static \Illuminate\Database\Eloquent\Builder|CarriageType whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CarriageType whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CarriageType whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CarriageType whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class CarriageType extends Model
{
}
