<?php

namespace App\Livewire\Pages\Specialties;

use Mary\Traits\Toast;
use Livewire\Component;
use App\Models\Specialtie;
use Illuminate\Support\Facades\Storage;
use Livewire\Features\SupportFileUploads\WithFileUploads;

class Edit extends Component
{
    use Toast, WithFileUploads;

    public ?Specialtie $specialtie = null;
    public String $acronym, $name, $description;
    public $image_path, $new_image;

    protected $rules = [
        'acronym' => 'required|string|max:50',
        'name' => 'required|string|max:60',
        'description' => 'required|string|max:500',
        'new_image' => 'nullable|image|max:300'
    ];

    public function mount()
    {
        $this->acronym = $this->specialtie->acronym;
        $this->name = $this->specialtie->name;
        $this->description = $this->specialtie->description;
        $this->image_path = $this->specialtie->image_path;
    }

    public function update()
    {
        $this->validate();

        if ($this->new_image) {
            if ($this->specialtie->image_path && Storage::disk('public')->exists($this->specialtie->image_path)) {
                Storage::disk('public')->delete($this->specialtie->image_path);
                $this->specialtie->image_path = $this->new_image->store('especialidades', 'public');
            }
            $this->specialtie->image_path = $this->new_image->store('especialidades', 'public');
        }

        $this->specialtie->acronym = $this->acronym;
        $this->specialtie->name = $this->name;
        $this->specialtie->description = $this->description;

        $this->specialtie->save();

        return $this->success(
            __('¡Actualizado exitosamente!'),
            __('Estás siendo redirigido.'),
            redirectTo: route('specialties.index')
        );
    }


    public function render()
    {
        return view('livewire.pages.specialties.edit');
    }
}
