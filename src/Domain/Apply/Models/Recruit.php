<?php

namespace Domain\Apply\Models;

use Domain\Apply\Builders\Recruit\RecruitBuilder;
use Domain\Apply\DataTransferObjects\RecruitData;
use Domain\Shared\Models\BaseModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
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
		'company_id',
		'prefecture_id',
	];

	public function company(): BelongsTo
	{
		return $this->belongsTo(Company::class);
	}

	public function entries(): HasMany
	{
		return $this->hasMany(Entry::class);
	}

	public function prefecture(): BelongsTo
	{
		return $this->belongsTo(Prefecture::class);
	}

	public function shokushuItems() : BelongsToMany
	{
		return $this->belongsToMany(ShokushuItem::class, 'recruits_shokushu_items');
	}

	public function newEloquentBuilder($query): RecruitBuilder
	{
		return new RecruitBuilder($query);
	}
}
