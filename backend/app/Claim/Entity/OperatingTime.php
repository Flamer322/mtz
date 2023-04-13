<?php

namespace App\Claim\Entity;

use App\Dictionary\Entity\CarriageSeries;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Claim\Entity\OperatingTime
 *
 * @property int $id
 * @property int $carriage_series_id
 * @property int $mileage
 * @property string $unit
 * @property int $count_carriage
 * @property \Illuminate\Support\Carbon $date
 * @property string|null $note
 * @property-read CarriageSeries $series
 * @method static \Illuminate\Database\Eloquent\Builder|OperatingTime newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|OperatingTime newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|OperatingTime query()
 * @method static \Illuminate\Database\Eloquent\Builder|OperatingTime whereCarriageSeriesId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OperatingTime whereCountCarriage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OperatingTime whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OperatingTime whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OperatingTime whereMileage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OperatingTime whereNote($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OperatingTime whereUnit($value)
 * @mixin \Eloquent
 */
class OperatingTime extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'mileage',
        'unit',
        'count_carriage',
        'date',
        'note',
    ];

    protected $casts = [
        'date' => 'datetime'
    ];

    public function series(): BelongsTo
    {
        return $this->belongsTo(CarriageSeries::class, 'carriage_series_id');
    }
}
