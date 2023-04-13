<?php

namespace App\Claim\Entity;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Claim\Entity\ClaimCompany
 *
 * @property int $id
 * @property string $short_name
 * @property string $full_name
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimCompany newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimCompany newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimCompany query()
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimCompany whereFullName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimCompany whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimCompany whereShortName($value)
 * @mixin \Eloquent
 */
class ClaimCompany extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'short_name',
        'full_name',
    ];
}
