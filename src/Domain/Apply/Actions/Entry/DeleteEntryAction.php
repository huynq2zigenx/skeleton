<?php

namespace Domain\Apply\Actions\Entry;

use Domain\Apply\DataTransferObjects\EntryData;
use Domain\Apply\Models\Entry;

class DeleteEntryAction
{
    public static function execute(EntryData $data): void
    {
        Entry::findOrFail($data->id)->delete();
    }

}
