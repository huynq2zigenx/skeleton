<?php

namespace Domain\Apply\Actions\Company;

use Domain\Apply\DataTransferObjects\CompanyData;
use Domain\Apply\Models\Company;
use Domain\Shared\Models\User;

class UpsertCompanyAction
{
    public static function execute(CompanyData $data, User $user): Company
    {
        $company = Company::updateOrCreate(
            [
                'id' => $data->id,
            ],
            [
                ...$data->all(),
                'user_id' => $user->id,
            ]
        );

        return $company;
    }

}
