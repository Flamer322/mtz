<?php

namespace App\Claim\Entity;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Claim\Entity\Claim
 *
 * @property int $id
 * @property int $defect_type_id
 * @property int $carriage_type_id
 * @property int $carriage_series_id
 * @property int $product_id
 * @property int $product_node_id
 * @property int $claim_company_id
 * @property string $number
 * @property string $theme
 * @property string|null $address
 * @property string|null $discover_date
 * @property string|null $kasant_number
 * @property string|null $carriage_number
 * @property string|null $manufacture_number
 * @property string|null $manufacture_product_date
 * @property string|null $assembly_serial_number
 * @property string|null $manufacture_date
 * @property string|null $time_to_failure
 * @property string|null $claimed_defect
 * @property string|null $identified_defect
 * @property string|null $comment
 * @method static \Illuminate\Database\Eloquent\Builder|Claim newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Claim newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Claim query()
 * @method static \Illuminate\Database\Eloquent\Builder|Claim whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Claim whereAssemblySerialNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Claim whereCarriageNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Claim whereCarriageSeriesId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Claim whereCarriageTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Claim whereClaimCompanyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Claim whereClaimedDefect($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Claim whereComment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Claim whereDefectTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Claim whereDiscoverDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Claim whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Claim whereIdentifiedDefect($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Claim whereKasantNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Claim whereManufactureDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Claim whereManufactureNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Claim whereManufactureProductDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Claim whereNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Claim whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Claim whereProductNodeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Claim whereTheme($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Claim whereTimeToFailure($value)
 * @mixin \Eloquent
 */
class Claim extends Model
{
}
