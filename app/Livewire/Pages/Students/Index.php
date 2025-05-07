<?php

namespace App\Livewire\Pages\Students;

use App\Models\Grup;
use App\Models\Level;
use App\Models\Specialtie;
use Mary\Traits\Toast;
use App\Models\Student;
use App\Models\SubGrup;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Pagination\LengthAwarePaginator;

class Index extends Component
{
    use WithPagination, Toast;

    public bool $modalDeletConf, $modalFilters = false;
    public $perPage = 10;
    public array $sortBy = ['column' => 'id_card', 'direction' => 'asc'];
    public string $search = '';
    public ?Student $student = null;
    public $specialties, $levels, $grups, $subGrups;

    public ?string $first_name = null;
    public ?string $middle_name = null;
    public ?string $last_name1 = null;
    public ?string $last_name2 = null;
    public ?string $id_card = null;

    public ?int $specialtie_id = null;
    public ?int $level_id = null;
    public ?int $grup_id = null;
    public ?int $sub_grup_id = null;
    public ?int $selectebleFiltersOptionsloaded = null;
    public int $activeFiltersCount = 0;


    public function mount()
    {
        $this->selectebleFiltersOptionsloaded = 0;
        $this->specialties = collect();
        $this->levels = collect();
        $this->grups = collect();
        $this->subGrups = collect();
    }

    public function students(): LengthAwarePaginator
    {
        $students = Student::query()
            ->with([
                'subGrup:id,grup_id,specialtie_id,name',
                'subGrup.specialtie:id,acronym',
                'subGrup.grup.level:id,name'
            ])
            ->when($this->first_name, fn($q) => $q->where('first_name', 'like', "%{$this->first_name}%"))
            ->when($this->middle_name, fn($q) => $q->where('middle_name', 'like', "%{$this->middle_name}%"))
            ->when($this->last_name1, fn($q) => $q->where('last_name1', 'like', "%{$this->last_name1}%"))
            ->when($this->last_name2, fn($q) => $q->where('last_name2', 'like', "%{$this->last_name2}%"))
            ->when($this->id_card, fn($q) => $q->where('id_card', 'like', "%{$this->id_card}%"))
            ->when($this->specialtie_id, fn($q) => $q->whereHas('subGrup.specialtie', fn($q2) => $q2->where('id', $this->specialtie_id)))
            ->when($this->level_id, fn($q) => $q->whereHas('subGrup.grup.level', fn($q2) => $q2->where('id', $this->level_id)))
            ->when($this->grup_id, fn($q) => $q->whereHas('subGrup.grup', fn($q2) => $q2->where('id', $this->grup_id)))
            ->when($this->sub_grup_id, fn($q) => $q->where('sub_grup_id', $this->sub_grup_id))
            ->when($this->search, function ($q) {
                $q->where(function ($sub) {
                    $sub->where('first_name', 'like', "%{$this->search}%")
                        ->orWhere('last_name1', 'like', "%{$this->search}%")
                        ->orWhere('last_name2', 'like', "%{$this->search}%")
                        ->orWhere('id_card', 'like', "%{$this->search}%")
                        ->orWhereHas('subGrup.grup.level', fn($q) => $q->where('name', 'like', "%{$this->search}%"))
                        ->orWhereHas('subGrup.specialtie', fn($q) => $q->where('acronym', 'like', "%{$this->search}%"));
                });
            })
            ->get();

        $sortCallbacks = [
            'id_card'     => fn($s) => $s->id_card,
            'last_name1'  => fn($s) => $s->last_name1,
            'last_name2'  => fn($s) => $s->last_name2,
            'name'        => fn($s) => $s->first_name,
            'level'       => fn($s) => optional($s->subGrup?->grup?->level)->name,
            'grup'        => fn($s) => optional($s->subGrup?->grup)->name,
            'specialtie'  => fn($s) => optional($s->subGrup?->specialtie)->acronym,
        ];

        $sortKey = $this->sortBy['column'];
        $direction = $this->sortBy['direction'];

        if (isset($sortCallbacks[$sortKey])) {
            $students = $direction === 'asc'
                ? $students->sortBy($sortCallbacks[$sortKey])
                : $students->sortByDesc($sortCallbacks[$sortKey]);
        }

        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $items = $students->slice(($currentPage - 1) * $this->perPage)->values();

        return new LengthAwarePaginator($items, $students->count(), $this->perPage, $currentPage);
    }

    public function deleteConf(Student $student): void
    {
        $this->student = $student;
        $this->modalDeletConf = true;
    }

    public function destroy(): void
    {
        $this->modalDeletConf = false;
        if ($this->student === null) {
            $this->error("No hay ningun estudiante seleccionada.");
            return;
        }
        $this->student->delete();
        $this->success(__('Eliminado exitosamente!'));
        $this->student = null;
    }

    public function applyFilters()
    {
        $this->resetPage();
        $this->modalFilters = false;
        $this->updateActiveFiltersCount();
    }

    public function clearFilters()
    {
        $this->reset([
            'first_name',
            'middle_name',
            'last_name1',
            'last_name2',
            'id_card',
            'specialtie_id',
            'level_id',
            'grup_id',
            'sub_grup_id',
            'search',
        ]);

        $this->resetPage();
        $this->modalFilters = false;
        $this->updateActiveFiltersCount();
    }

    public function selectebleFiltersOptions()
    {
        if ($this->selectebleFiltersOptionsloaded == 0) {
            $this->selectebleFiltersOptionsloaded = 1;
            $this->specialties = Specialtie::select('id', 'acronym')->get();
            $this->levels = Level::select('id', 'name')->get();
            $this->loadGrups();
            $this->loadSubGrups();
        }
    }

    public function updateActiveFiltersCount()
    {
        $this->activeFiltersCount = collect([
            $this->first_name,
            $this->middle_name,
            $this->last_name1,
            $this->last_name2,
            $this->id_card,
            $this->specialtie_id,
            $this->level_id,
            $this->grup_id,
            $this->sub_grup_id,
        ])->filter(fn($value) => !is_null($value) && $value !== '')->count();
    }

    public function loadGrups()
    {
        $this->grups = Grup::select('id', 'name')->where('level_id', $this->level_id)->get();
        return $this->grups;
    }

    public function loadSubGrups()
    {
        $this->subGrups = SubGrup::with('specialtie:id,acronym')
            ->select('id', 'specialtie_id', 'grup_id', 'name')
            ->where('grup_id', $this->grup_id)
            ->get()
            ->map(function ($subGrup) {
                $subGrup->name = $subGrup->name . ' - ' . ($subGrup->specialtie->acronym ?? '');
                return $subGrup;
            });
        return $this->subGrups;
    }

    public function render()
    {
        $headers = [
            ['key' => 'last_name1', 'label' => __('Primer Apellido')],
            ['key' => 'last_name2', 'label' => __('Segundo Apellido')],
            ['key' => 'name', 'label' => __('Nombre')],
            ['key' => 'id_card', 'label' => __('Cédula')],
            ['key' => 'level', 'label' => __('Nivel')],
            ['key' => 'grup', 'label' => __('Sección')],
            ['key' => 'specialtie', 'label' => __('Especialidad')],
        ];

        return view('livewire.pages.students.index', [
            'headers' => $headers,
            'students' => $this->students(),
        ]);
    }
}
