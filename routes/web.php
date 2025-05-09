<?php

use App\Livewire\Pages\Home;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});


