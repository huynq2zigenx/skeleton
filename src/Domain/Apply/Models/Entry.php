<?php

namespace Domain\Apply\Models;

use Domain\Apply\DataTransferObjects\EntryData;
use Domain\Apply\Observers\EntryObservers;
use Domain\Shared\Models\BaseModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\LaravelData\WithData;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;


#[ObservedBy([EntryObservers::class])]
class Entry extends BaseModel
{
	use WithData;

    protected $dataClass = EntryData::class;

    protected $fillable = [
        'first_name',
        'last_name',
        'phone',
        'email',
        'company_id'
    ];

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

}
