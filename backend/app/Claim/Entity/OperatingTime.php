<?php

namespace App\Claim\Entity;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Claim\Entity\OperatingTime
 *
 * @property int $id
 * @property int $carriage_series_id
 * @property int $mileage
 * @property string $unit
 * @property int $count_carriage
 * @property string $date
 * @property string|null $note
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
}
