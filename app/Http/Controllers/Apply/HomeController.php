<?php

namespace App\Http\Controllers\Apply;

use Domain\Apply\ViewModels\RecruitViewModels;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class HomeController
{
	public function index(Request $request): Response
    {
        return Inertia::render('Home/Index', [
            'model' => new RecruitViewModels($request->get('page',1))
        ]);
    }
}
