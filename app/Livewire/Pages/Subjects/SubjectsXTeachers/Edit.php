<?php

namespace App\Livewire\Pages\Subjects\SubjectsXTeachers;

use App\Models\Level;
use Mary\Traits\Toast;
use App\Models\SubGrup;
use App\Models\Subject;
use App\Models\Teacher;
use Livewire\Component;
use App\Models\Specialtie;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use App\Models\SubjectsTaughtByTeachers;

class Edit extends Component
{
    use Toast;

    public ?SubjectsTaughtByTeachers $subjectxteacher = null;
    public ?int $teacher_searchable_id = null;
    public Collection $teachersSearchable;
    public ?int $level_id = 1;
    public ?int $specialtie_id = 1;
    public array $subjects = [];
    public array $subgrups = [];
    public ?int $subgrup_id = null;
    public ?int $subject_id = null;

    protected $rules = [
        'subject_id' => 'required|exists:subjects,id',
        'teacher_searchable_id' => 'required|exists:teachers,id',
        'subgrup_id' => 'required|exists:sub_grups,id',
    ];

    public function mount()
    {
        $this->teacher_searchable_id = $this->subjectxteacher->teacher_id;
        $this->subgrup_id = $this->subjectxteacher->sub_grup_id;
        $this->subject_id = $this->subjectxteacher->subject_id;
        $this->level_id = $this->subjectxteacher->subGrup->grup->level_id;
        $this->specialtie_id = $this->subjectxteacher->subGrup->specialtie_id;
        $this->loadSubjects();
        $this->loadSubgrups();
        $this->searchTeachers();
    }

    public function new_specialtie_id()
    {
        $this->loadSubjects();
        $this->loadSubgrups(); 
        $this->searchTeachers();
    }

    public function new_level_id()
    {
        $this->loadSubgrups();
        $this->searchTeachers();
    }

    public function loadSubjects()
    {
        $this->subjects = Subject::where('specialtie_id', $this->specialtie_id)
            ->select('id', 'name')
            ->get()
            ->toArray();
    }

    public function searchTeachers(string $value = '')
    {
        $selectedOption = Teacher::select('id', DB::raw("CONCAT(first_name, ' ', middle_name, ' ', last_name1, ' ', last_name2) as name"))
            ->where('id', $this->teacher_searchable_id)
            ->get();

        $this->teachersSearchable = Teacher::query()
            ->select('id', DB::raw("CONCAT(first_name, ' ', middle_name, ' ', last_name1, ' ', last_name2) as name"))
            ->where('first_name', 'like', '%' . $value . '%')
            ->orderBy('first_name')
            ->take(10)
            ->get()
            ->merge($selectedOption);
    }

    public function loadSubgrups()
    {
        $this->subgrups = SubGrup::with('grup:id,name,level_id')
            ->where('specialtie_id', $this->specialtie_id)
            ->whereHas('grup', function ($query) {
                $query->where('level_id', $this->level_id);
            })
            ->get()
            ->map(function ($subgrup) {
                $subgrup->name = "Grupo {$subgrup->grup->name} - {$subgrup->name}";
                return $subgrup;
            })
            ->toArray();
    }

    public function update()
    {
        $this->validate();

        $this->subjectxteacher->teacher_id = $this->teacher_searchable_id;
        $this->subjectxteacher->sub_grup_id = $this->subgrup_id;
        $this->subjectxteacher->subject_id = $this->subject_id;
        $this->subjectxteacher->save();

        return $this->success(
            __('¡Actualizado Exitosamente!'),
            __('Estas siendo redirigido.'),
            redirectTo: route('subjectsxteachers.index')
        );
    }

    public function render()
    {
        $specialties = Specialtie::select('id', 'acronym')->get();
        $levels = Level::select('id', 'name')->get();

        return view('livewire.pages.subjects.subjects-x-teachers.edit', [
            'specialties' => $specialties,
            'levels' => $levels,
        ]);
    }
}
