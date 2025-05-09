<?php

namespace App\Livewire\Pages\Subjects;

use Mary\Traits\Toast;
use Livewire\Component;
use App\Models\Specialtie;
use App\Models\Subject;
use Livewire\WithPagination;
use Illuminate\Pagination\LengthAwarePaginator;

class Index extends Component
{
    use WithPagination, Toast;

    public bool $modalDeletConf, $modalCreate, $modalEdit = false;
    public String $name;
    public int $selectedSpecialtie;
    public $perPage = 10;
    public array $sortBy = ['column' => 'name', 'direction' => 'asc'];
    public string $search = '';
    public ?Subject $subject = null;

    protected $rules = [
        'selectedSpecialtie' => 'required|exists:specialties,id',
        'name' => 'required|string|max:100',
    ];

    public function subjects(): LengthAwarePaginator
    {
        $query = Subject::with('specialtie:id,acronym')
            ->when($this->search, function ($q) {
                $q->where(function ($q2) {
                    $q2->where('name', 'like', "%{$this->search}%")
                        ->orWhereHas('specialtie', fn($q3) => $q3->where('acronym', 'like', "%{$this->search}%"));
                });
            });

        $sortMap = [
            'specialtie.acronym' => Specialtie::select('acronym')
                ->whereColumn('specialties.id', 'subjects.specialtie_id')
                ->limit(1),
            'name' => 'name',
            'id'   => 'id',
        ];

        $sortColumn = $this->sortBy['column'] ?? 'id';
        $sortDirection = $this->sortBy['direction'] ?? 'asc';
        $sortValue = $sortMap[$sortColumn] ?? 'id';
        $query->orderBy($sortValue, $sortDirection);
        
        return $query->paginate($this->perPage);
    }

    public function store()
    {
        $this->validate();

        Subject::create([
            'specialtie_id' => $this->selectedSpecialtie,
            'name' => $this->name,
        ]);

        $this->modalCreate = false;
        $this->name = '';
        $this->success(__('¡Materia Creada Exitosamnete!'));
    }

    public function edit(Subject $subject)
    {
        $this->subject = $subject;
        $this->name = $subject->name;
        $this->selectedSpecialtie = $subject->specialtie_id;
        $this->modalEdit = true;
    }

    public function update()
    {
        $this->validate();

        $this->subject->name = $this->name;
        $this->subject->specialtie_id = $this->selectedSpecialtie;
        $this->subject->save();

        $this->modalEdit = false;
        $this->name = '';
        $this->success(__('¡Materia Actualizada Exitosamnete!'));
    }

    public function deleteConf(Subject $subject): void
    {
        $this->subject = $subject;
        $this->modalDeletConf = true;
    }

    public function destroy(): void
    {
        $this->modalDeletConf = false;
        if ($this->subject === null) {
            $this->error("No hay ninguna especialidad seleccionada.");
            return;
        }
        $this->subject->delete();
        $this->subject = null;
        $this->success(__('Eliminado exitosamente!'));
    }

    public function render()
    {
        $heders = [
            ['key' => 'specialtie.acronym', 'label' => __('Especialidad')],
            ['key' => 'name', 'label' => __('Materia')],
        ];

        $specialtie = Specialtie::select('id', 'acronym')->get();

        return view('livewire.pages.subjects.index', [
            'headers' => $heders,
            'subjects' => $this->subjects(),
            'specialties' => $specialtie,
        ]);
    }
}
