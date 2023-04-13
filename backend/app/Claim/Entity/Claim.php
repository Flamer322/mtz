<?php

namespace App\Claim\Entity;

use App\Dictionary\Entity\CarriageSeries;
use App\Dictionary\Entity\CarriageType;
use App\Product\Entity\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Claim\Entity\Claim
 *
 * @property int $id
 * @property int|null $defect_type_id
 * @property int|null $carriage_type_id
 * @property int|null $carriage_series_id
 * @property int|null $product_id
 * @property int|null $product_node_id
 * @property int|null $claim_company_id
 * @property string $number
 * @property string $theme
 * @property string|null $address
 * @property \Illuminate\Support\Carbon|null $discover_date
 * @property string|null $kasant_number
 * @property string|null $carriage_number
 * @property string|null $manufacture_number
 * @property \Illuminate\Support\Carbon|null $manufacture_product_date
 * @property string|null $assembly_serial_number
 * @property \Illuminate\Support\Carbon|null $manufacture_date
 * @property string|null $time_to_failure
 * @property string|null $claimed_defect
 * @property string|null $identified_defect
 * @property string|null $comment
 * @property-read CarriageType|null $carriageType
 * @property-read \App\Claim\Entity\ClaimCompany|null $company
 * @property-read \App\Claim\Entity\DefectType|null $defectType
 * @property-read \App\Claim\Entity\ProductNode|null $node
 * @property-read Product|null $product
 * @property-read CarriageSeries|null $series
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
    public $timestamps = false;

    protected $fillable = [
        'number',
        'theme',
        'address',
        'discover_date',
        'kasant_number',
        'carriage_number',
        'manufacture_number',
        'manufacture_product_date',
        'assembly_serial_number',
        'manufacture_date',
        'time_to_failure',
        'claimed_defect',
        'identified_defect',
        'comment',
    ];

    protected $casts = [
        'discover_date' => 'datetime',
        'manufacture_product_date' => 'datetime',
        'manufacture_date' => 'datetime',
    ];

    public function defectType(): ?BelongsTo
    {
        return $this->belongsTo(DefectType::class, 'defect_type_id');
    }

    public function carriageType(): ?BelongsTo
    {
        return $this->belongsTo(CarriageType::class, 'carriage_type_id');
    }

    public function series(): ?BelongsTo
    {
        return $this->belongsTo(CarriageSeries::class, 'carriage_series_id');
    }

    public function product(): ?BelongsTo
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function node(): ?BelongsTo
    {
        return $this->belongsTo(ProductNode::class, 'product_node_id');
    }

    public function company(): ?BelongsTo
    {
        return $this->belongsTo(ClaimCompany::class, 'claim_company_id');
    }
}
