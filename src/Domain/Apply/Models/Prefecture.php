<?php

namespace Domain\Apply\Models;

use Domain\Apply\DataTransferObjects\PrefectureData;
use Domain\Shared\Models\BaseModel;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\LaravelData\WithData;

class Prefecture extends BaseModel
{
	use WithData;
	protected $dataClass = PrefectureData::class;

	protected $fillable = [
        'area_name',
        'name',
        'cnt'
    ];

	public function recruits() : HasMany
	{
		return $this->hasMany(Recruit::class);
	}
}
