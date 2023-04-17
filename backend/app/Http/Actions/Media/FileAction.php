<?php

namespace App\Http\Actions\Media;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Storage;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\StreamedResponse;

class FileAction extends Controller
{
    public function __invoke(string $name, Request $request): StreamedResponse
    {
        $media = Media::where(['uuid' => $name])->firstOrFail();

        return Storage::disk(config('nova.storage_disk'))->response(
            $media->id . '/' . $media->file_name,
            $media->name
        );
    }
}
