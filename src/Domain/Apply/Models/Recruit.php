<?php

namespace Domain\Apply\Models;

use Domain\Apply\DataTransferObjects\RecruitData;
use Domain\Shared\Models\BaseModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\LaravelData\WithData;
class Recruit extends BaseModel
{
	use WithData;

    protected $dataClass = RecruitData::class;

    protected $fillable = [
        'title',
        'description',
        'start_date',
        'end_date',
        'company_id'
    ];

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }
}
