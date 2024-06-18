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
	public function create(Recruit $recruit): Response
    {
		return Inertia::render('Entry/Index', [
            'model' => new UpsertRecruitViewModel($recruit)
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        UpsertEntryAction::execute(
            EntryData::validateAndCreate($request)
        );

        return Redirect::route('home');
    }
}
