<?php

namespace App\Report\Entity;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Report\Entity\AlgorithmParameter
 *
 * @property int $id
 * @property string $key
 * @property string $name
 * @property float $value
 * @method static \Illuminate\Database\Eloquent\Builder|AlgorithmParameter newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AlgorithmParameter newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AlgorithmParameter query()
 * @method static \Illuminate\Database\Eloquent\Builder|AlgorithmParameter whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AlgorithmParameter whereKey($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AlgorithmParameter whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AlgorithmParameter whereValue($value)
 * @mixin \Eloquent
 */
class AlgorithmParameter extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'key',
        'name',
        'value',
    ];
}
