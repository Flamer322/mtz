<?php

namespace App\Dictionary\Entity;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Dictionary\Entity\CarriageSeries
 *
 * @property int $id
 * @property int $type_id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Dictionary\Entity\CarriageType $type
 * @method static \Illuminate\Database\Eloquent\Builder|CarriageSeries newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CarriageSeries newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CarriageSeries query()
 * @method static \Illuminate\Database\Eloquent\Builder|CarriageSeries whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CarriageSeries whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CarriageSeries whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CarriageSeries whereTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CarriageSeries whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class CarriageSeries extends Model
{
    public $timestamps = true;

    protected $fillable = [
        'name',
    ];

    public function type(): BelongsTo
    {
        return $this->belongsTo(CarriageType::class, 'type_id');
    }
}
