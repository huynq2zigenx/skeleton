<?php

namespace App\Http\Controllers\Apply;

use Domain\Apply\Actions\Company\UpsertCompanyAction;
use Domain\Apply\DataTransferObjects\CompanyData;
use Domain\Apply\Models\Company;
use Domain\Apply\ViewModels\CompanyViewModels;
use Domain\Apply\ViewModels\UpsertCompanyViewModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Http\RedirectResponse;

class CompanyController
{
    public function index(Request $request): Response
    {
        return Inertia::render('Company/Index', [
            'model' => new CompanyViewModels($request->get('page',1))
        ]);
    }

    public function create(Request $request): Response
    {
        return Inertia::render('Company/Create', [
            'model' => new UpsertCompanyViewModel()
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        UpsertCompanyAction::execute(
            CompanyData::validateAndCreate($request->all()),
            $request->user()
        );

        return Redirect::route('companies.index');
    }

    public function edit(Company $company): Response
    {
        return Inertia::render('Company/Edit', [
            'model' => new UpsertCompanyViewModel($company)
        ]);
    }

    public function update(Request $request, Company $company): RedirectResponse
    {
        UpsertCompanyAction::execute(
            CompanyData::validateAndCreate($request->all()),
            $request->user()
        );

        return Redirect::route('companies.index');

    }

}
