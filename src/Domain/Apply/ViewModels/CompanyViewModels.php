<?php

namespace Domain\Apply\ViewModels;

use Domain\Apply\Models\Company;
use Domain\Shared\ViewModel\ViewModel;
use Illuminate\Pagination\Paginator;

class CompanyViewModels extends ViewModel
{
    private const PER_PAGE = 10;

    public function __construct(private readonly int $currentPage)
    {
    }

    public function companies(): Paginator
    {
        $items = Company::with(['user'])
            ->orderBy('created_at', 'desc')
            ->get()
            ->map
            ->getData();

        $items = $items->slice(self::PER_PAGE * ($this->currentPage - 1));

        return new Paginator($items, self::PER_PAGE, $this->currentPage, [
            'path' => route('companies.index'),
        ]);
    }

    public function total(): int
    {
        return Company::count();
    }

}
