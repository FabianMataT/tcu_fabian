<?php

namespace App\Livewire\Pages\Students;

use App\Models\Level;
use App\Models\Grup;
use Mary\Traits\Toast;
use App\Models\Student;
use App\Models\SubGrup;
use Livewire\Component;

class Edit extends Component
{
    use Toast;

    public ?Student $student = null;
    public ?int $level_id, $grup_id, $sub_grup_id = null;
    public String $first_name, $middle_name, $last_name1, $last_name2, $id_card;

    protected $rules = [
        'first_name' => 'required|string|max:50',
        'middle_name' => 'nullable|string|max:50',
        'last_name1' => 'required|string|max:50',
        'last_name2' => 'required|string|max:50',
        'id_card' => 'required|string|max:11',
        'sub_grup_id' => 'required|exists:sub_grups,id',
    ];

    public function mount(){
        $this->level_id = $this->student->subGrup->grup->level_id;
        $this->grup_id = $this->student->subGrup->grup_id;
        $this->sub_grup_id = $this->student->sub_grup_id;
        $this->first_name = $this->student->first_name;
        $this->middle_name = $this->student->middle_name;
        $this->last_name1 = $this->student->last_name1;
        $this->last_name2 = $this->student->last_name2;
        $this->id_card = $this->student->id_card;
    }

    public function update()
    {
        $this->validate();

        $this->student->update([
            'sub_grup_id' => $this->sub_grup_id,
            'id_card' => $this->id_card,
            'first_name' => $this->first_name,
            'middle_name' => $this->middle_name ?? '',
            'last_name1' => $this->last_name1,
            'last_name2' => $this->last_name2,
        ]);

        return $this->success(
            __('Actualiazado exitosamente!'),
            __('Estas siendo redirigido.'),
            redirectTo: route('students.index')
        );
    }

    public function new_level_id(){
        $this->grup_id = null;
        $this->sub_grup_id = null;
        $this->loadGrups();
    }

    public function new_grup_id(){
        $this->sub_grup_id = null;
        $this->loadSubGrups();
    }

    public function loadGrups() {
        return Grup::select('id', 'name')->where('level_id', $this->level_id)->get();
    }

    public function loadSubGrups()
    {
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
        $levels = Level::select('id', 'name')->get();
            
        return view('livewire.pages.students.edit', [
            'levels' => $levels,
            'grups' => $this->loadGrups(),
            'subGrups' => $this->loadSubGrups(),
        ]);
    }
}
