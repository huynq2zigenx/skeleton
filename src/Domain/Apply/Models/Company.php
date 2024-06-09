<?php

namespace Domain\Apply\Models;

use Domain\Apply\DataTransferObjects\CompanyData;
use Domain\Shared\Models\BaseModel;
use Domain\Shared\Models\User;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\LaravelData\WithData;

class Company extends BaseModel
{
    use WithData;

    protected $dataClass = CompanyData::class;

    protected $fillable = [
        'name',
        'address',
        'user_id'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
