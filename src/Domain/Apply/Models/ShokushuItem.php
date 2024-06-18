<?php

namespace Domain\Apply\Models;

use Domain\Apply\DataTransferObjects\ShokushuItemData;
use Domain\Shared\Models\BaseModel;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Spatie\LaravelData\WithData;

class ShokushuItem extends BaseModel
{
	use WithData;

    protected $dataClass = ShokushuItemData::class;
	protected $guarded = [];

	public function recruits() : BelongsToMany
	{
		return $this->belongsToMany(Recruit::class, 'recruits_shokushu_items');
	}
}
