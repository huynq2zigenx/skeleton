<?php

namespace Domain\Apply\ViewModels;

use Domain\Apply\Models\Recruit;
use Domain\Shared\ViewModel\ViewModel;
use Illuminate\Pagination\Paginator;

class RecruitViewModels extends ViewModel
{
    private const PER_PAGE = 20;

    public function __construct(private readonly int $currentPage)
    {
    }

    public function recruits(): Paginator
    {
        $items = Recruit::with(['company'])
            ->orderBy('created_at', 'desc')
            ->get()
            ->map
            ->getData();

        $items = $items->slice(self::PER_PAGE * ($this->currentPage - 1));

        return new Paginator($items, self::PER_PAGE, $this->currentPage, [
            'path' => route('recruits.index'),
        ]);
    }

    public function total(): int
    {
        return Recruit::count();
    }
}
