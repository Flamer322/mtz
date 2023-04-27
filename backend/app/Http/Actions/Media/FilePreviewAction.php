<?php

namespace App\Http\Actions\Media;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\StreamedResponse;

class FilePreviewAction extends Controller
{
    public function __invoke(string $name, Request $request): StreamedResponse
    {
        $media = Media::where(['uuid' => $name])->firstOrFail();

        return Storage::disk(config('nova.storage_disk'))->response(
            Str::after($media->preview_url, 'storage/media/'),
            $media->name
        );
    }
}
