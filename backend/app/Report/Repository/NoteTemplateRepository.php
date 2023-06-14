<?php

namespace App\Report\Repository;

use App\Report\Entity\NoteTemplate;

final class NoteTemplateRepository
{
    public function removeOld(string $type): void
    {
        NoteTemplate::whereType($type)->delete();
    }
}
