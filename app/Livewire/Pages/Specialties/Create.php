<?php

namespace App\Livewire\Pages\Specialties;

use Mary\Traits\Toast;
use Livewire\Component;
use App\Models\Specialtie;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Livewire\Features\SupportFileUploads\WithFileUploads;

class Create extends Component
{
    use Toast, WithFileUploads;
    
    public String $acronym, $name, $description;
    public $image;

    protected $rules = [
        'acronym' => 'required|string|max:50',
        'name' => 'required|string|max:60',
        'description' => 'required|string|max:500',
        'image' => 'required|image|max:300'
    ];

    public function store()
    {
        $this->validate();
        $image_path = null; 

        if ($this->image) {  
            $image_path = Storage::put('especialidades', $this->image);
        }

        Specialtie::create([
            'acronym' => $this->acronym,
            'name' => $this->name,
            'description' => $this->description,
            'image_path' => $image_path,
            'slug' => $this->stringToSlug($this->acronym)
        ]);

        return $this->success(
            __('¡Creado exitosamente!'),
            __('Estas siendo redirigido.'),
            redirectTo: route('specialties.index')
        );
    }

    private function stringToSlug(string $str): string
    {
        $str = trim($str);
        $str = mb_strtolower($str, 'UTF-8');
        $from = ['à', 'á', 'ä', 'â', 'è', 'é', 'ë', 'ê', 'ì', 'í', 'ï', 'î', 
                'ò', 'ó', 'ö', 'ô', 'ù', 'ú', 'ü', 'û', 'ñ', 'ç', '·', '/', '_', ',', ':', ';'];
        $to   = ['a',  'a',  'a',  'a',  'e',  'e',  'e',  'e',  'i',  'i',  'i',  'i',
                'o',  'o',  'o',  'o',  'u',  'u',  'u',  'u',  'n',  'c', '-', '-', '-', '-', '-', '-'];
        $str = str_replace($from, $to, $str);
        $str = preg_replace('/[^a-z0-9 -]/', '', $str);
        $str = preg_replace('/\s+/', '-', $str);
        $str = preg_replace('/-+/', '-', $str);
        return $str;
    }

    public function render()
    {
        return view('livewire.pages.specialties.create');
    }
}
