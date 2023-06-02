<?php

namespace App\Catalog\Command\Order\Create;

use Spatie\LaravelData\Data;

final class Command extends Data
{
    public int $buyerCompany;
    public int $payerCompany;
    public int $recipientCompany;
    public ?string $contactName = null;
    public ?string $contactPhone = null;
    public ?string $contactEmail = null;
    public ?string $documentType = null;
    public ?string $comment = null;
    public ?string $endUserOfProduct = null;
    public ?string $deliveryDate = null;
    public ?array $lines = [];
    public ?array $files = [];
}
