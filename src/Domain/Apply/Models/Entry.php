<?php

namespace Domain\Apply\Models;

use Domain\Apply\DataTransferObjects\EntryData;
use Domain\Shared\Models\BaseModel;
use Domain\Shared\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\LaravelData\WithData;

class Entry extends BaseModel
{
    use WithData;

    protected  $dataClass = EntryData::class;

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'phone',
        'user_id',
        'company_id'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }
}
