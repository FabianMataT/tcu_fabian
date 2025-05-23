<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Models\Specialtie;
use Illuminate\Http\Request;

class SpecialtieController extends Controller
{

    public ?Specialtie $specialtie = null;

    public function index()
    {
        $specialties = \App\Models\Specialtie::select('id', 'name', 'description', 'image_path', 'slug')->get();

        return view('guest.specialties.index', ['specialties' => $specialties]);
    }

    public function show(Specialtie $specialtie)
    {
        return view('guest.specialties.show', [
            'specialtie' => $specialtie,
        ]);
    }
}
