<?php

namespace Domain\Apply\ViewModels;

use Domain\Apply\Models\Prefecture;
use Domain\Apply\Models\Recruit;
use Domain\Apply\Models\ShokushuItem;
use Domain\Shared\ViewModel\ViewModel;
use Illuminate\Database\Eloquent\Builder;
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
        $query = Recruit::with(['company', 'prefecture']);
        $this->applyFilters($query);
        $items = $query->orderBy('created_at', 'desc')->get()->map->getData();
		$items = $items->slice(self::PER_PAGE * ($this->currentPage - 1));

		return new Paginator($items, self::PER_PAGE, $this->currentPage, [
			'path' => $this->path ?? route('recruits.index'),
		]);
	}

	public function total(): int
	{
        $query = Recruit::with(['company', 'prefecture']);
        $this->applyFilters($query);
        return $query->count();
	}
    private function applyFilters(Builder $query): void
    {
        $query->when(!empty($this->query['freeword']), fn ($q) => $q->whereTileAndDescription($this->query['freeword']));
        $query->when(!empty($this->query['prefectures']), fn ($q) => $q->whereInPrefectures($this->query['prefectures']));
        $query->when(!empty($this->query['shokushu_items']), fn ($q) => $q->whereBelongToShokushu($this->query['shokushu_items']));
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
