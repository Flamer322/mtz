<?php

namespace App\Report\Entity;

use App\Claim\Entity\ClaimCompany;
use App\Dictionary\Entity\CarriageSeries;
use App\Dictionary\Entity\CarriageType;
use App\Product\Entity\Product;
use App\User\Entity\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

/**
 * App\Report\Entity\SummaryReport
 *
 * @property int $id
 * @property int|null $company_id
 * @property int $created_by
 * @property string $name
 * @property int $confidence_probability
 * @property \Illuminate\Support\Carbon $period_from_date
 * @property \Illuminate\Support\Carbon $period_to_date
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read ClaimCompany|null $company
 * @property-read User $createdBy
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Product> $products
 * @property-read int|null $products_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, CarriageSeries> $series
 * @property-read int|null $series_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, CarriageType> $types
 * @property-read int|null $types_count
 * @method static \Illuminate\Database\Eloquent\Builder|SummaryReport newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SummaryReport newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SummaryReport query()
 * @method static \Illuminate\Database\Eloquent\Builder|SummaryReport whereCompanyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SummaryReport whereConfidenceProbability($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SummaryReport whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SummaryReport whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SummaryReport whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SummaryReport whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SummaryReport wherePeriodFromDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SummaryReport wherePeriodToDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SummaryReport whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class SummaryReport extends Model implements HasMedia
{
    use InteractsWithMedia;

    public const MEDIA_COLLECTION = 'summary-report.files';

    public $timestamps = true;

    protected $fillable = [
        'name',
        'confidence_probability',
        'period_from_date',
        'period_to_date',
    ];

    protected $casts = [
        'period_from_date' => 'datetime',
        'period_to_date' => 'datetime',
    ];

    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function company(): ?BelongsTo
    {
        return $this->belongsTo(ClaimCompany::class, 'company_id');
    }

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class,'summary_report_products', 'report_id', 'product_id');
    }

    public function series(): BelongsToMany
    {
        return $this->belongsToMany(CarriageSeries::class,'summary_report_series', 'report_id', 'series_id');
    }

    public function types(): BelongsToMany
    {
        return $this->belongsToMany(CarriageType::class,'summary_report_types', 'report_id', 'type_id');
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection(self::MEDIA_COLLECTION)
            ->singleFile();
    }
}
