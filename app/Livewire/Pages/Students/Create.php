<?php

namespace App\Livewire\Pages\Students;

use App\Models\Grup;
use App\Models\Level;
use Mary\Traits\Toast;
use App\Models\Student;
use App\Models\SubGrup;
use Livewire\Component;

class Create extends Component
{
    use Toast;

    public ?int $level_id, $grup_id, $sub_grup_id = null;
    public String $first_name, $middle_name, $last_name1, $last_name2, $id_card;
    public $levels;

    protected $rules = [
        'first_name' => 'required|string|max:50',
        'middle_name' => 'nullable|string|max:50',
        'last_name1' => 'required|string|max:50',
        'last_name2' => 'required|string|max:50',
        'id_card' => 'required|string|max:11',
        'sub_grup_id' => 'required|exists:sub_grups,id',
    ];

    public function mount(){
        $this->level_id = 0;
        $this->grup_id = 0;
    }

    public function store()
    {
        $this->validate();

        Student::create([
            'sub_grup_id' => $this->sub_grup_id,
            'id_card' => $this->id_card,
            'first_name' => $this->first_name,
            'middle_name' => $this->middle_name ?? '',
            'last_name1' => $this->last_name1,
            'last_name2' => $this->last_name2,
        ]);

        return $this->success(
            __('¡Creado exitosamente!'),
            __('Estas siendo redirigido.'),
            redirectTo: route('students.index')
        );
    }
    

    public function loadGrups()
    {
        $this->sub_grup_id = null;
        return Grup::select('id', 'name')->where('level_id', $this->level_id)->get();
    }

    public function loadSubGrups()
    {
        $this->sub_grup_id = null;
        return SubGrup::with('specialtie:id,acronym')
            ->select('id', 'specialtie_id', 'grup_id', 'name')
            ->where('grup_id', $this->grup_id)
            ->get()
            ->map(function ($subGrup) {
                $subGrup->name = $subGrup->name . ' - ' . ($subGrup->specialtie->acronym ?? '');
                return $subGrup;
            });
    }

    public function render()
    {
        $this->levels = Level::select('id', 'name')->get();

        return view('livewire.pages.students.create', [
            'levels' => $this->levels,
            'grups' => $this->loadGrups(),
            'subGrups' => $this->loadSubGrups(),
        ]);
    }
}
