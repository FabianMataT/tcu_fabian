<?php

namespace App\Livewire\Pages\Grups;

use App\Models\Grup;
use App\Models\User;
use App\Models\Level;
use Mary\Traits\Toast;
use App\Models\SubGrup;
use Livewire\Component;
use App\Models\Specialtie;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Pagination\LengthAwarePaginator;

class Index extends Component
{
    use WithPagination, Toast;

    public bool $modalDeletConf, $modalCreate, $modalEdit, $modalLevelUp = false;
    public $perPage = 10;
    public array $sortBy = ['column' => 'level_id', 'direction' => 'asc'];
    public string $search = '';
    public $name, $selectedLevel, $selectedSpecialtieA, $selectedSpecialtieB;
    public ?Grup $grup = null;
    public ?SubGrup $subGrupA = null;
    public ?SubGrup $subGrupB = null;
    public ?User $user = null;

    public function mount()
    {
        $this->user = Auth::user();
    }

    protected $rules = [
        'selectedLevel' => 'required|exists:levels,id',
        'selectedSpecialtieA' => 'required|exists:specialties,id',
        'selectedSpecialtieB' => 'nullable|exists:specialties,id',
        'name' => 'required|string|max:50',
    ];

    public function grups(): LengthAwarePaginator
    {
        $grups = Grup::with(['level:id,name', 'specialtiesXGrup:specialties.id,acronym', 'subGrup:id', 'subGrup:subjects_taught_by_teacher.id,teacher_id'])
            ->when(
                $this->user?->teacher?->first_name,
                fn($q) => $q->whereHas('subGrup.subjects_taught_by_teacher', function ($query) {
                    $query->where('teacher_id', $this->user->teacher->id);
                })
            )
            ->when($this->search, function ($query) {
                $query->where(function ($q) {
                    $q->where('name', 'like', "%{$this->search}%")
                        ->orWhereHas('level', function ($q) {
                            $q->where('name', 'like', "%{$this->search}%");
                        })
                        ->orWhereHas('specialtiesXGrup', function ($q) {
                            $q->where('acronym', 'like', "%{$this->search}%");
                        });
                });
            })
            ->get();

        $grups = match ($this->sortBy['column']) {
            'specialtiesXGrup' => $this->sortBy['direction'] === 'asc'
                ? $grups->sortBy(fn($item) => $item->specialties_string)
                : $grups->sortByDesc(fn($item) => $item->specialties_string),
            default => $this->sortBy['direction'] === 'asc'
                ? $grups->sortBy($this->sortBy['column'])
                : $grups->sortByDesc($this->sortBy['column']),
        };

        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $paginated = $grups->slice(($currentPage - 1) * $this->perPage, $this->perPage)->values();

        return new LengthAwarePaginator($paginated, $grups->count(), $this->perPage, $currentPage);
    }

    public function store()
    {
        $this->validate();

        DB::beginTransaction();
        try {
            $grup = Grup::create([
                'level_id' => $this->selectedLevel,
                'name' => $this->name,
            ]);

            if ($this->selectedSpecialtieA && $this->selectedSpecialtieB) {
                foreach (['A' => $this->selectedSpecialtieA, 'B' => $this->selectedSpecialtieB] as $letter => $specialtieId) {
                    SubGrup::create([
                        'grup_id' => $grup->id,
                        'specialtie_id' => $specialtieId,
                        'name' => $letter,
                    ]);
                }
            } else {
                SubGrup::create([
                    'grup_id' => $grup->id,
                    'specialtie_id' => $this->selectedSpecialtieA,
                    'name' => 'A',
                ]);
            }
            DB::commit();
            $this->reset(['modalCreate', 'name', 'selectedLevel', 'selectedSpecialtieA', 'selectedSpecialtieB']);
            $this->success(__('¡Grupo creado exitosamente!'));
        } catch (\Exception $e) {
            DB::rollBack();
            $this->error(__('Hubo un error al crear el grupo. Intente nuevamente.'));
        }
    }

    public function edit(Grup $grup)
    {
        $this->grup = $grup;
        $this->selectedLevel = $grup->level_id;
        $this->name = $grup->name;
        $this->subGrupA = $this->grup->subGrup->where('name', 'A')->first();
        $this->subGrupB = $this->grup->subGrup->where('name', 'B')->first();
        $this->selectedSpecialtieA = $this->subGrupA->specialtie_id ?? null;
        $this->selectedSpecialtieB = $this->subGrupB->specialtie_id ?? null;
        $this->modalEdit = true;
    }

    public function update()
    {
        $this->validate();

        if (!$this->grup) {
            $this->error('Grupo no encontrado.');
            return;
        }

        DB::beginTransaction();
        try {
            $this->grup->update([
                'level_id' => $this->selectedLevel,
                'name' => $this->name,
            ]);

            $subgrups = [
                'A' => ['instance' => $this->subGrupA, 'specialtie' => $this->selectedSpecialtieA],
                'B' => ['instance' => $this->subGrupB, 'specialtie' => $this->selectedSpecialtieB],
            ];

            foreach ($subgrups as $name => $data) {
                if ($data['instance']) {
                    if ($data['specialtie']) {
                        $data['instance']->update(['specialtie_id' => $data['specialtie']]);
                    }
                } elseif ($data['specialtie']) {
                    SubGrup::create([
                        'grup_id' => $this->grup->id,
                        'specialtie_id' => $data['specialtie'],
                        'name' => $name,
                    ]);
                }
            }
            DB::commit();
            $this->reset(['modalEdit', 'name', 'selectedLevel', 'selectedSpecialtieA', 'selectedSpecialtieB', 'grup']);
            $this->success(__('¡Grupo actualizado exitosamente!'));
        } catch (\Exception $e) {
            DB::rollBack();
            $this->error(__('Hubo un error al actualizar el grupo. Intente nuevamente.'));
        }
    }

    public function deleteConf(Grup $grup): void
    {
        $this->grup = $grup;
        $this->modalDeletConf = true;
    }

    public function destroy(): void
    {
        $this->modalDeletConf = false;
        if ($this->grup === null) {
            $this->error("No hay ningun grupo seleccionada.");
            return;
        }
        $this->grup->delete();
        $this->success(__('Eliminado exitosamente!'));
        $this->grup = null;
    }

    public function levelUp()
    {
        try {
            DB::transaction(function () {
                $gruposAEliminar = Grup::where('level_id', 4)->get();
                foreach ($gruposAEliminar as $grupo) {
                    $grupo->delete();
                }

                Grup::where('level_id', '<', 4)->increment('level_id');
            });
            $this->modalLevelUp = false;
            $this->success(__('¡Grupos actualizados exitosamente!'));
        } catch (\Exception $e) {
            $this->modalLevelUp = false;
            $this->error(__('No se actualizaron los grupos!'));
        }
    }

    public function render()
    {
        $headers = [
            ['key' => 'level_id', 'label' => __('Nivel')],
            ['key' => 'name', 'label' => __('Grupo')],
            ['key' => 'specialtiesXGrup', 'label' => __('Especialidades')],
        ];

        $levels = Level::select('id', 'name')->get();

        $specialties = Specialtie::select('id', 'acronym')->get();

        return view('livewire.pages.grups.index', [
            'grups' => $this->grups(),
            'headers' => $headers,
            'levels' => $levels,
            'specialties' => $specialties,
        ]);
    }
}
