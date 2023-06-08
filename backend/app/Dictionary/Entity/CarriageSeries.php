<?php

namespace App\Dictionary\Entity;

use App\Claim\Entity\OperatingTime;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * App\Dictionary\Entity\CarriageSeries
 *
 * @property int $id
 * @property int $type_id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, OperatingTime> $operating
 * @property-read int|null $operating_count
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

    public function operating(): HasMany
    {
        return $this->hasMany(OperatingTime::class,'carriage_series_id');
    }
}
