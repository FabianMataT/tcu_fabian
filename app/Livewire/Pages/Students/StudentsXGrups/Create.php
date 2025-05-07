<?php

namespace App\Livewire\Pages\Students\StudentsXGrups;

use App\Models\Grup;
use App\Models\Student;
use Mary\Traits\Toast;
use App\Models\SubGrup;
use Livewire\Component;
use Illuminate\Support\Facades\DB;

class Create extends Component
{
    use Toast;

    public ?Grup $grup = null;
    public String $first_name, $middle_name, $last_name1, $last_name2, $id_card;
    public int $sub_grup_id;

    protected $rules = [
        'first_name' => 'required|string|max:50',
        'middle_name' => 'nullable|string|max:50',
        'last_name1' => 'required|string|max:50',
        'last_name2' => 'required|string|max:50',
        'id_card' => 'required|string|max:11',
        'sub_grup_id' => 'required|exists:sub_grups,id',
    ];

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
            redirectTo: route('grups.show', $this->grup->id)
        );
    }

    public function render()
    {
        $subGrups = SubGrup::with('specialtie:id,acronym')
            ->select('id', 'specialtie_id', 'grup_id', 'name')
            ->where('grup_id', $this->grup->id)
            ->get()
            ->map(function ($subGrup) {
                $subGrup->name = $subGrup->name . ' - ' . ($subGrup->specialtie->acronym ?? '');
                return $subGrup;
            });

        return view('livewire.pages.students.students-x-grups.create', [
            'subGrups' => $subGrups
        ]);
    }
}
