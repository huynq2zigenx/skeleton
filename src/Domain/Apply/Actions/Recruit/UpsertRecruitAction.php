<?php

namespace Domain\Apply\Actions\Recruit;

use Domain\Apply\DataTransferObjects\RecruitData;
use Domain\Apply\DataTransferObjects\ShokushuItemData;
use Domain\Apply\Models\Recruit;

class UpsertRecruitAction
{
    public static function execute(RecruitData $data): Recruit
    {
        $recruit = Recruit::updateOrCreate(
            [
                'id' => $data->id,
            ],
            [
                ...$data->all(),
                'company_id' => $data->company->id,
                'prefecture_id' => $data->prefecture->id
            ]
        );

		$recruit->shokushuItems()->sync(array_column($data->shokushuItems->toArray(), 'id'));

        return $recruit;
    }

}
