<?php

namespace Domain\Apply\Builders\Recruit;

use Illuminate\Database\Eloquent\Builder;

class RecruitBuilder extends Builder
{
	public function whereInPrefectures(array $prefectures): self
	{
		return $this->whereIn('prefecture_id', $prefectures);
	}

	public function whereBelongToShokushu(array $shokushuItemIds): self
	{
		return $this->whereHas('shokushuItems', function ($query) use ($shokushuItemIds) {
			$query->whereIn('shokushu_items.id', $shokushuItemIds);
		});
	}

	public function whereTileAndDescription(string $freeword): self
	{
		return $this->whereAny([
			'title',
			'description',
		], 'LIKE', "%$freeword%");
	}
}
