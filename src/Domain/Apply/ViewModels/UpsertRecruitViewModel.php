<?php

namespace Domain\Apply\ViewModels;

use Domain\Apply\DataTransferObjects\RecruitData;
use Domain\Apply\Models\Company;
use Domain\Apply\Models\Recruit;
use Domain\Shared\ViewModel\ViewModel;

class UpsertRecruitViewModel extends ViewModel
{
    public function __construct(public readonly ?Recruit $recruit = null)
    {
    }

    public function recruit(): ?RecruitData
    {
        return $this->recruit?->load('company')->getData();
    }

	public function companies()
    {
        return Company::get();
    }
}