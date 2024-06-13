<?php

namespace App\Http\Controllers\Apply;

use Domain\Apply\Actions\Recruit\UpsertRecruitAction;
use Domain\Apply\DataTransferObjects\RecruitData;
use Domain\Apply\Models\Company;
use Domain\Apply\Models\Recruit;
use Domain\Apply\ViewModels\RecruitViewModels;
use Domain\Apply\ViewModels\UpsertRecruitViewModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Http\RedirectResponse;

class RecruitController
{
	public function index(Request $request): Response
    {
        return Inertia::render('Recruit/Index', [
            'model' => new RecruitViewModels($request->get('page',1))
        ]);
    }

    public function create(Request $request): Response
    {
        return Inertia::render('Recruit/Create', [
            'model' => new UpsertRecruitViewModel()
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        UpsertRecruitAction::execute(
            RecruitData::fromRequest($request),
            Company::where('id', $request->company_id)->first()
        );

        return Redirect::route('recruits.index');
    }

	public function edit(Recruit $recruit): Response
    {
        return Inertia::render('Recruit/Edit', [
            'model' => new UpsertRecruitViewModel($recruit)
        ]);
    }

    public function update(Request $request): Response
    {
        return Inertia::render('Recruit/Create', [
            'model' => new UpsertRecruitViewModel()
        ]);
    }

}
