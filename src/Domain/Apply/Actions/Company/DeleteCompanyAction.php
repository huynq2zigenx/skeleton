<?php

namespace Domain\Apply\Actions\Company;

use Domain\Apply\DataTransferObjects\CompanyData;
use Domain\Apply\Models\Company;

class DeleteCompanyAction
{
    public static function execute(CompanyData $data): void
    {
        Company::findOrFail($data->id)->delete();
    }

}
