<?php

namespace App\Http\Controllers\Apply;

use Domain\Apply\Actions\Entry\UpsertEntryAction;
use Domain\Apply\DataTransferObjects\EntryData;
use Domain\Apply\Models\Company;
use Domain\Apply\Models\Entry;
use Domain\Apply\ViewModels\EntryViewModels;
use Domain\Apply\ViewModels\UpsertEntryViewModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Http\RedirectResponse;

class EntryController
{
	public function index(Request $request): Response
    {
        return Inertia::render('Entry/Index', [
            'model' => new EntryViewModels($request->get('page',1))
        ]);
    }

    public function create(Request $request): Response
    {
        return Inertia::render('Entry/Create', [
            'model' => new UpsertEntryViewModel()
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        UpsertEntryAction::execute(
            EntryData::fromRequest($request),
            Company::where('id', $request->company_id)->first()
        );

        return Redirect::route('Entry.index');
    }

	public function edit(Entry $Entry): Response
    {
        return Inertia::render('Entry/Edit', [
            'model' => new UpsertEntryViewModel($Entry)
        ]);
    }

    public function update(Request $request): Response
    {
        return Inertia::render('Entry/Create', [
            'model' => new UpsertEntryViewModel()
        ]);
    }

}
