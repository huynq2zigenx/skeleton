<?php

namespace Domain\Apply\ViewModels;

use Domain\Apply\DataTransferObjects\RecruitData;
use Domain\Apply\Models\Company;
use Domain\Apply\Models\Prefecture;
use Domain\Apply\Models\Recruit;
use Domain\Apply\Models\ShokushuItem;
use Domain\Shared\ViewModel\ViewModel;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\Paginator;

class RecruitViewModels extends ViewModel
{
	private const PER_PAGE = 20;

	public function __construct(private readonly int $currentPage, private readonly string $path, private readonly array $query = [])
	{
	}

	public function recruits(): Paginator
	{
		$items = Recruit::with(['company', 'prefecture'])
			->when(!empty($this->query['freeword']), fn ($query) => $query->whereTileAndDescription($this->query['freeword']))
			->when(!empty($this->query['prefectures']), fn ($query) => $query->whereInPrefectures($this->query['prefectures']))
			->when(!empty($this->query['shokushu_items']), fn ($query) => $query->whereBelongToShokushu($this->query['shokushu_items']))
			->orderBy('created_at', 'desc')
			->get()
			->map
			->getData();
		
		$items = $items->slice(self::PER_PAGE * ($this->currentPage - 1));

		return new Paginator($items, self::PER_PAGE, $this->currentPage, [
			'path' => $this->path ?? route('recruits.index'),
		]);
	}

	public function total(): int
	{
		return Recruit::with(['company', 'prefecture'])
			->when(!empty($this->query['freeword']), fn ($query) => $query->whereTileAndDescription($this->query['freeword']))
			->when(!empty($this->query['prefectures']), fn ($query) => $query->whereInPrefectures($this->query['prefectures']))
			->when(!empty($this->query['shokushu_items']), fn ($query) => $query->whereBelongToShokushu($this->query['shokushu_items']))
			->orderBy('created_at', 'desc')
			->get()
			->count();


	}

	public function prefectures(): Collection
	{
		return Prefecture::all();
	}

	public function shokushuItems(): Collection
	{
		return ShokushuItem::orderBy('snum')->get();
	}
}
