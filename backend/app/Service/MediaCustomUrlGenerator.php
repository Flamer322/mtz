<?php

namespace App\Service;

use DateTimeInterface;
use Illuminate\Contracts\Config\Repository as Config;
use Illuminate\Routing\UrlGenerator;
use Illuminate\Support\Carbon;
use Spatie\MediaLibrary\Support\UrlGenerator\DefaultUrlGenerator;

class MediaCustomUrlGenerator extends DefaultUrlGenerator
{
    public function __construct(
        private readonly UrlGenerator $urlGenerator,
        protected Config $config
    ) {
        parent::__construct($this->config);
    }

    public function getTemporaryUrl(DateTimeInterface $expiration, array $options = []): string
    {
        return $this->urlGenerator->temporarySignedRoute(
            'storage.media',
            Carbon::now()->addMinutes(10),
            ['name' => $this->media->uuid]
        );
    }
}
