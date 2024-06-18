<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Apply\CompanyController;
use App\Http\Controllers\Apply\EntryController;
use App\Http\Controllers\Apply\HomeController;
use App\Http\Controllers\Apply\RecruitController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/about', function () {
    return Inertia::render('About');
});

Route::middleware('auth')->group(function () {
    Route::Resource('companies', CompanyController::class);
	Route::Resource('recruits', RecruitController::class);
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/entry/{recruit}', [EntryController::class, 'create'])->name('entry.create');
Route::post('/entry', [EntryController::class, 'store'])->name('entry.store');
Route::get('/recruits/detail/{recruit}', [RecruitController::class, 'detail'])->name('recruits.detail');

require __DIR__.'/auth.php';
