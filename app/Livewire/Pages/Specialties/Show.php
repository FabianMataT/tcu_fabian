<?php

namespace App\Livewire\Pages\Specialties;

use App\Models\Specialtie;
use Livewire\Component;

class Show extends Component
{
    public ?Specialtie $specialtie = null;

    public function render()
    {
        return view('livewire.pages.specialties.show');
    }
}
