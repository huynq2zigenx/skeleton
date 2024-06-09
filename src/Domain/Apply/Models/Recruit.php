<?php

namespace Domain\Apply\Models;

use Domain\Apply\DataTransferObjects\RecruitData;
use Domain\Shared\Models\BaseModel;
use Domain\Shared\Models\User;
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
        'user_id',
        'company_id'
    ];

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
