<?php

namespace App\Product\Entity;

use App\Dictionary\Entity\CarriageSeries;
use App\Dictionary\Entity\Category;
use App\Dictionary\Entity\Status;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

/**
 * App\Product\Entity\Product
 *
 * @property int $id
 * @property int $status_id
 * @property string $article
 * @property string $name
 * @property string $slug
 * @property string|null $description
 * @property string|null $note
 * @property bool $is_spare_part
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Category> $categories
 * @property-read int|null $categories_count
 * @property-read \App\Product\Entity\ProductDetail|null $detail
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Product\Entity\ProductAdditionalField> $fields
 * @property-read int|null $fields_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Product\Entity\Image> $files
 * @property-read int|null $files_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Product\Entity\Image> $images
 * @property-read int|null $images_count
 * @property-read \Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection<int, Media> $media
 * @property-read int|null $media_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Product> $modifications
 * @property-read int|null $modifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, CarriageSeries> $series
 * @property-read int|null $series_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Product> $spare_parts
 * @property-read int|null $spare_parts_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Product> $spare_parts_reverse
 * @property-read int|null $spare_parts_reverse_count
 * @property-read Status $status
 * @method static \Illuminate\Database\Eloquent\Builder|Product newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Product newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Product onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Product query()
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereArticle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereIsSparePart($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereNote($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereStatusId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Product withoutTrashed()
 * @mixin \Eloquent
 */
class Product extends Model implements HasMedia
{
    use SoftDeletes, InteractsWithMedia, HasSlug;

    public const MEDIA_COLLECTION = 'product.images';

    public $timestamps = true;

    protected $fillable = [
        'article',
        'name',
        'description',
        'note',
        'is_spare_part',
    ];

    public function status(): BelongsTo
    {
        return $this->belongsTo(Status::class, 'status_id');
    }

    public function series(): BelongsToMany
    {
        return $this->belongsToMany(CarriageSeries::class,'product_series', 'product_id', 'series_id');
    }

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class,'product_categories', 'product_id', 'category_id');
    }

    public function images(): BelongsToMany
    {
        return $this->belongsToMany(Image::class,'product_images', 'product_id', 'image_id');
    }

    public function files(): BelongsToMany
    {
        return $this->belongsToMany(Image::class,'product_files', 'product_id', 'file_id');
    }

    public function fields(): HasMany
    {
        return $this->hasMany(ProductAdditionalField::class,'product_id')
            ->orderBy('sort_order', 'asc');
    }

    public function detail(): HasOne
    {
        return $this->hasOne(ProductDetail::class,'product_id');
    }

    public function spare_parts(): BelongsToMany
    {
        return $this->belongsToMany(Product::class,'product_spare_parts', 'product_id', 'spare_part_id');
    }

    public function spare_parts_reverse(): BelongsToMany
    {
        return $this->belongsToMany(Product::class,'product_spare_parts', 'spare_part_id', 'product_id');
    }

    public function modifications(): BelongsToMany
    {
        return $this->belongsToMany(Product::class,'product_modifications', 'product_id', 'modification_id');
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
        $this->addMediaCollection(self::MEDIA_COLLECTION)
            ->singleFile();
    }

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom(['article', 'name'])
            ->saveSlugsTo('slug');
    }
}
