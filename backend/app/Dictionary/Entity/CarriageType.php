<?php

namespace App\Dictionary\Entity;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * App\Dictionary\Entity\CarriageType
 *
 * @property int $id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Dictionary\Entity\CarriageSeries> $series
 * @property-read int|null $series_count
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
    public $timestamps = true;

    protected $fillable = [
        'name',
    ];

    public function series(): HasMany
    {
        return $this->hasMany(CarriageSeries::class, 'type_id');
    }
}
