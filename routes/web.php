<?php

use App\Http\Controllers\Guest\AdmissionController;
use App\Livewire\Pages\Home;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Guest\SpecialtieController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/guets/admissions/index', [AdmissionController::class, 'index'])->name('guest.admissions.index');
Route::get('/guets/specialties/index', [SpecialtieController::class, 'index'])->name('guest.specialties.index');
Route::get('/guets/specialties/show/{specialtie}', [SpecialtieController::class, 'show'])->name('guest.specialties.show');

Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified',])->group(function () {

    Route::get('/dashboard', Home::class)->name('dashboard');
});
