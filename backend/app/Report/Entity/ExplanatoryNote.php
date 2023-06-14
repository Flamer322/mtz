<?php

namespace App\Report\Entity;

use App\Product\Entity\Product;
use App\User\Entity\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

/**
 * App\Report\Entity\ExplanatoryNote
 *
 * @property int $id
 * @property int $product_id
 * @property int $created_by
 * @property string $name
 * @property int $confidence_probability
 * @property \Illuminate\Support\Carbon $period_from_date
 * @property \Illuminate\Support\Carbon $period_to_date
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read User $createdBy
 * @property-read \Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection<int, \Spatie\MediaLibrary\MediaCollections\Models\Media> $media
 * @property-read int|null $media_count
 * @property-read Product $product
 * @method static \Illuminate\Database\Eloquent\Builder|ExplanatoryNote newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ExplanatoryNote newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ExplanatoryNote query()
 * @method static \Illuminate\Database\Eloquent\Builder|ExplanatoryNote whereConfidenceProbability($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ExplanatoryNote whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ExplanatoryNote whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ExplanatoryNote whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ExplanatoryNote whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ExplanatoryNote wherePeriodFromDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ExplanatoryNote wherePeriodToDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ExplanatoryNote whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ExplanatoryNote whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class ExplanatoryNote extends Model implements HasMedia
{
    use InteractsWithMedia;

    public const MEDIA_COLLECTION = 'explanatory-note.files';

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

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection(self::MEDIA_COLLECTION)
            ->singleFile();
    }
}
