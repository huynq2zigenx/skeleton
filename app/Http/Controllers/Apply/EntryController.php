<?php

namespace App\Http\Controllers\Apply;

use Domain\Apply\Actions\Entry\DeleteEntryAction;
use Domain\Apply\Actions\Entry\UpsertEntryAction;
use Domain\Apply\DataTransferObjects\EntryData;
use Domain\Apply\Models\Entry;
use Domain\Apply\ViewModels\EntryViewModels;
use Domain\Apply\ViewModels\UpsertEntryViewModel;
use Illuminate\Http\Request;
use Domain\Apply\Models\Recruit;
use Domain\Apply\ViewModels\UpsertRecruitViewModel;
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

	public function index2(Recruit $recruit): Response
    {
		return Inertia::render('EntryApply/Index', [
            'model' => new UpsertRecruitViewModel($recruit)
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
            EntryData::validateAndCreate($request)
        );

        return Redirect::route('home');
    }

	public function edit(Entry $Entry): Response
    {
        return Inertia::render('Entry/Edit', [
            'model' => new UpsertEntryViewModel($Entry)
        ]);
    }
	
    public function update(Request $request): RedirectResponse
    {
        UpsertCompanyAction::execute(
            EntryData::validateAndCreate($request)
        );

        return Redirect::route('entries.index');

    }

	public function show(Entry $Entry): Response
    {
        return Inertia::render('Entry/Show', [
            'model' => new UpsertEntryViewModel($Entry)
        ]);
    }

	public function destroy(Recruit $recruit): RedirectResponse
    {
        DeleteEntryAction::execute(
			RecruitData::fromModel($recruit)
		);

		return Redirect::route('recruits.index');
    }
}
