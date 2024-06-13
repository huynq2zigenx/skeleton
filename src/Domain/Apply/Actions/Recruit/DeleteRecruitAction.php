<?php

namespace Domain\Apply\Actions\Recruit;

use Domain\Apply\DataTransferObjects\RecruitData;
use Domain\Apply\Models\Recruit;

class DeleteRecruitAction
{
    public static function execute(RecruitData $data): void
    {
        Recruit::findOrFail($data->id)->delete();
    }

}
