<?php

namespace Domain\Apply\ViewModels;

use Domain\Apply\DataTransferObjects\CompanyData;
use Domain\Apply\Models\Company;
use Domain\Shared\ViewModel\ViewModel;

class UpsertCompanyViewModel extends ViewModel
{
    public function __construct(public readonly ?Company $company = null)
    {
    }

    public function company(): ?CompanyData
    {
        return $this->company?->load('user')->getData();

    }

}
