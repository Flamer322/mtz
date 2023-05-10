<?php

namespace App\Product\Entity;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\URL;
use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

/**
 * App\Product\Entity\File
 *
 * @property int $id
 * @property string $name
 * @property string $type
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection<int, Media> $media
 * @property-read int|null $media_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Product\Entity\Product> $products
 * @property-read int|null $products_count
 * @method static \Illuminate\Database\Eloquent\Builder|File newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|File newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|File query()
 * @method static \Illuminate\Database\Eloquent\Builder|File whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|File whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|File whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|File whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|File whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class File extends Model implements HasMedia
{
    use InteractsWithMedia;

    public const MEDIA_COLLECTION = 'file.files';

    public $timestamps = true;

    protected $fillable = [
        'name',
        'type',
    ];

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class, 'product_files', 'file_id', 'product_id');
    }

    public function files(): ?MediaCollection
    {
        return $this->getMedia(self::MEDIA_COLLECTION);
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

    public const FILE_TYPES = [
        'operational' => 'Эксплуатационные документы',
        'certificate' => 'Сертификат или декларация',
        'software' => 'Программное обеспечение',
        'other' => 'Другое'
    ];

    public const FILE_FORMAT_URLS = [
        'doc' => '/img/file-icons/doc.png',
        'docx' => '/img/file-icons/docx.png',
        'pdf' => '/img/file-icons/pdf.png',
        'zip' => '/img/file-icons/zip.png',
        'tif' => '/img/file-icons/tif.png',
        'tiff' => '/img/file-icons/tif.png',
        'none' => '/img/file-icons/none.png'
    ];

    private const FILE_FORMAT_PREVIEWS = [
        'jpg',
        'jpeg',
        'png'
    ];

    public function getFileExtensionPreview(): string
    {
        if (!$file = $this->files()[0]) {
            return '';
        }

        if (in_array(pathinfo($file->file_name, PATHINFO_EXTENSION), self::FILE_FORMAT_PREVIEWS, false)) {
            return URL::temporarySignedRoute(
                'storage.media',
                Carbon::now()->addMinutes(10),
                ['name' => $file->uuid]
            );
        }

        $extension = strtolower(pathinfo($file->file_name, PATHINFO_EXTENSION));

        if (isset(self::FILE_FORMAT_URLS[$extension])) {
            return asset(self::FILE_FORMAT_URLS[$extension]);
        }

        return asset(self::FILE_FORMAT_URLS['none']);
    }
}
