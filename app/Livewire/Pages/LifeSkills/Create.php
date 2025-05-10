<?php

namespace App\Livewire\Pages\LifeSkills;

use App\Models\LifeSkill;
use Mary\Traits\Toast;
use Livewire\Component;

class Create extends Component
{
    use Toast;
    
    public string $name, $description;

    protected $rules = [
        'name' => 'required|string|max:60',
        'description' => 'required|string|max:300',
    ];

    public function store()
    {
        $this->validate();

        LifeSkill::create([
            'name' => $this->name,
            'description' => $this->description,
        ]);

        return $this->success(
            __('¡Creado exitosamente!'),
            __('Estas siendo redirigido.'),
            redirectTo: route('life.skills.index')
        );
    }

    public function render()
    {
        return view('livewire.pages.life-skills.create');
    }
}
