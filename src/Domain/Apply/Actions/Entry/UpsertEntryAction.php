<?php

namespace Domain\Apply\Actions\Entry;

use Domain\Apply\DataTransferObjects\EntryData;
use Domain\Apply\Models\Company;
use Domain\Apply\Models\Entry;

class UpsertEntryAction
{
    public static function execute(EntryData $data): Entry
    {
        $entry = Entry::updateOrCreate(
            [
                'id' => $data->id,
            ],
            [
                ...$data->all(),
                'company_id' => $data->company->id,
            ]
        );

        return $entry;
    }

}
