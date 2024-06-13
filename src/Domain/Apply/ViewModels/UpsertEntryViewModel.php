<?php

namespace Domain\Apply\ViewModels;

use Domain\Apply\DataTransferObjects\EntryData;
use Domain\Apply\Models\Company;
use Domain\Apply\Models\Entry;
use Domain\Shared\ViewModel\ViewModel;

class UpsertEntryViewModel extends ViewModel
{
    public function __construct(public readonly ?Entry $entry = null)
    {
    }

    public function entry(): ?EntryData
    {
        return $this->entry?->load('company')->getData();
    }

	public function companies()
    {
        return Company::get();
    }
}