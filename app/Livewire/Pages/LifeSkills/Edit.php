<?php

namespace App\Livewire\Pages\LifeSkills;

use App\Models\LifeSkill;
use Mary\Traits\Toast;
use Livewire\Component;

class Edit extends Component
{
    use Toast;

    public ?LifeSkill $life_skill = null;
    public string $name, $description;

    protected $rules = [
        'name' => 'required|string|max:60',
        'description' => 'required|string|max:300',
    ];

    public function mount()
    {
        $this->name = $this->life_skill->name;
        $this->description = $this->life_skill->description;
    }

    public function update()
    {
        $this->validate();

        $this->life_skill->update([
            'name' => $this->name,
            'description' => $this->description,
        ]);

        return $this->success(
            __('Actualizado exitosamente!'),
            __('Estas siendo redirigido.'),
            redirectTo: route('life.skills.index') 
        );
    }

    public function render()
    {
        return view('livewire.pages.life-skills.edit');
    }
}
