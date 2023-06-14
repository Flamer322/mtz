<?php

namespace App\Nova\Report\Observers;

use App\Report\Entity\NoteTemplate;
use App\Report\Repository\NoteTemplateRepository;
use File;

final class NoteTemplateObserver
{
    public function __construct(
        private readonly NoteTemplateRepository $templates
    )
    {
    }

    public function creating(NoteTemplate $noteTemplate): void
    {
        $this->templates->removeOld($noteTemplate->type);
    }

    public function saved(NoteTemplate $noteTemplate): void
    {
        if (!File::exists(storage_path() . NoteTemplate::DIRS[$noteTemplate->type])) {
            File::makeDirectory(storage_path() . NoteTemplate::DIRS[$noteTemplate->type], recursive: true);
        }

        File::move(storage_path() . '/app/' . $noteTemplate->file,
            storage_path() . NoteTemplate::DIRS[$noteTemplate->type] . '/template.docx');
    }
}
