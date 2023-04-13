<?php

namespace App\Claim\Entity;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Claim\Entity\ClaimFile
 *
 * @property int $id
 * @property int $claim_id
 * @property string $file
 * @property string $name
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimFile newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimFile newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimFile query()
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimFile whereClaimId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimFile whereFile($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimFile whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimFile whereName($value)
 * @mixin \Eloquent
 */
class ClaimFile extends Model
{
}
