<?php

namespace App\GraphQL\Types\Media;

use Illuminate\Routing\UrlGenerator;
use Illuminate\Support\Carbon;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

final class FileType
{
    public function __construct(
        private readonly UrlGenerator $urlGenerator
    ) {
    }

    public function url(Media $media): string
    {
        return $this->urlGenerator->temporarySignedRoute(
            'storage.media',
            Carbon::now()->addMinutes(10),
            ['name' => $media->uuid]
        );
    }

    public function mime(Media $media): string
    {
        return $media->mime_type;
    }

    public function size(Media $media): ?int
    {
        return $media->size;
    }
}
