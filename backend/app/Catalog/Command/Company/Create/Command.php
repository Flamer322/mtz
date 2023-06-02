<?php

namespace App\Catalog\Command\Company\Create;

use Spatie\LaravelData\Data;

final class Command extends Data
{
    public string $legalName;
    public ?string $legalAddress = null;
    public ?string $postAddress = null;
    public ?string $inn = null;
    public ?string $okpo = null;
    public ?string $kpp = null;
    public ?string $ogrn = null;
    public ?string $bik = null;
    public ?string $corrAccount = null;
    public ?string $bankAccount = null;
    public ?string $mainOrganization = null;
    public ?string $shortName = null;
    public ?string $bankName = null;
    public ?string $directorPost = null;
    public ?string $directorName = null;
}
