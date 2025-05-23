<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {

        $specialties = \App\Models\Specialtie::select('id', 'name', 'image_path', 'slug')->get();

        $slides = [];

        foreach ($specialties as $specialty) {
            $slides[] = [
                'image' => $specialty->image,
                'title' => $specialty->name,
                'url' => route('guest.specialtie.show', $specialty),
            ];
        }

        return view('home', ['slides' => $slides]);
    }
}
