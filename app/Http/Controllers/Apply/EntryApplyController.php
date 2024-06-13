<?php

namespace App\Http\Controllers\Apply;

use Domain\Apply\Actions\Entry\UpsertEntryAction;
use Domain\Apply\DataTransferObjects\EntryData;
use Domain\Apply\Models\Recruit;
use Domain\Apply\ViewModels\UpsertRecruitViewModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Http\RedirectResponse;

class EntryApplyController
{
	public function index(Recruit $recruit): Response
    {
		return Inertia::render('EntryApply/Index', [
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
