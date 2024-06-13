<?php

namespace Domain\Apply\Actions\Recruit;

use Domain\Apply\DataTransferObjects\RecruitData;
use Domain\Apply\Models\Company;
use Domain\Apply\Models\Recruit;

class UpsertRecruitAction
{
    public static function execute(RecruitData $data, Company $company): Recruit
    {
        $recruit = Recruit::updateOrCreate(
            [
                'id' => $data->id,
            ],
            [
                ...$data->all(),
                'company_id' => $company->id,
            ]
        );

        return $recruit;
    }

}
