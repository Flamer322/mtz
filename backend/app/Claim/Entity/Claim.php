<?php

namespace App\Claim\Entity;

use App\Dictionary\Entity\CarriageSeries;
use App\Dictionary\Entity\CarriageType;
use App\Product\Entity\Product;
use App\User\Entity\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

/**
 * App\Claim\Entity\Claim
 *
 * @property int $id
 * @property int|null $defect_type_id
 * @property int|null $carriage_type_id
 * @property int|null $carriage_series_id
 * @property int|null $product_id
 * @property int|null $product_node_id
 * @property int $claim_company_id
 * @property int $created_by
 * @property int|null $managed_by
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
 * @property string|null $created_at
 * @property string|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read CarriageType|null $carriageType
 * @property-read \App\Claim\Entity\ClaimCompany $company
 * @property-read User $createdBy
 * @property-read \App\Claim\Entity\DefectType|null $defectType
 * @property-read User|null $managedBy
 * @property-read \Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection<int, Media> $media
 * @property-read int|null $media_count
 * @property-read \App\Claim\Entity\ProductNode|null $node
 * @property-read Product|null $product
 * @property-read CarriageSeries|null $series
 * @method static \Illuminate\Database\Eloquent\Builder|Claim newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Claim newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Claim onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Claim query()
 * @method static \Illuminate\Database\Eloquent\Builder|Claim whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Claim whereAssemblySerialNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Claim whereCarriageNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Claim whereCarriageSeriesId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Claim whereCarriageTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Claim whereClaimCompanyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Claim whereClaimedDefect($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Claim whereComment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Claim whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Claim whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Claim whereDefectTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Claim whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Claim whereDiscoverDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Claim whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Claim whereIdentifiedDefect($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Claim whereKasantNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Claim whereManagedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Claim whereManufactureDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Claim whereManufactureNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Claim whereManufactureProductDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Claim whereNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Claim whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Claim whereProductNodeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Claim whereTheme($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Claim whereTimeToFailure($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Claim whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Claim withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Claim withoutTrashed()
 * @mixin \Eloquent
 */
class Claim extends Model implements HasMedia
{
    use SoftDeletes, InteractsWithMedia;

    public const MEDIA_COLLECTION = 'claim.files';

    public $timestamps = true;

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

    public function company(): BelongsTo
    {
        return $this->belongsTo(ClaimCompany::class, 'claim_company_id');
    }

    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function managedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'managedBy');
    }

    public function registerMediaConversions(Media $media = null): void
    {
        $this
            ->addMediaConversion('preview')
            ->fit(Manipulations::FIT_CROP, 300, 300)
            ->nonQueued();
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection(self::MEDIA_COLLECTION);
    }
}
