<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Pages\Home;


Route::get('/', function () {
    return view('welcome');
});


Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified',])->group(function () {

    Route::get('/dashboard', Home::class)->name('dashboard');
});
