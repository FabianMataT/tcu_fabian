<?php

namespace App\Livewire\Pages\Grups;

use App\Models\Grup;
use App\Models\Student;
use Mary\Traits\Toast;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Pagination\LengthAwarePaginator;

class Show extends Component
{
    use WithPagination, Toast;

    public bool $modalDeletConf = false;
    public $perPage = 10;
    public array $sortBy = ['column' => 'id_card', 'direction' => 'asc'];
    public string $search = '';
    public ?Grup $grup = null;
    public ?Student $student = null;

    public function students(): LengthAwarePaginator
    {
        $students = Student::query()
            ->with([
                'subGrup:id,grup_id,specialtie_id,name',
                'subGrup.specialtie:id,acronym'
            ])
            ->whereHas('subGrup', fn($q) => $q->where('grup_id', $this->grup->id))
            ->when($this->search, function ($query) {
                $query->where(function ($q) {
                    $q->where('first_name', 'like', "%{$this->search}%")
                        ->orWhere('last_name1', 'like', "%{$this->search}%")
                        ->orWhere('last_name2', 'like', "%{$this->search}%")
                        ->orWhere('id_card', 'like', "%{$this->search}%")
                        ->orWhereHas('subGrup.specialtie', fn($q) => $q->where('acronym', 'like', "%{$this->search}%"));
                });
            })
            ->get();

        $sortCallbacks = [
            'id_card'     => fn($s) => $s->id_card,
            'first_name'  => fn($s) => $s->first_name,
            'last_name1'  => fn($s) => $s->last_name1,
            'subgrup'     => fn($s) => optional($s->subGrup)->name,
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

    public function render()
    {
        $headers = [
            ['key' => 'id_card', 'label' => __('Cédula')],
            ['key' => 'first_name', 'label' => __('Nombre')],
            ['key' => 'last_name1', 'label' => __('Apellidos')],
            ['key' => 'subgrup', 'label' => __('Subgrupo')],
            ['key' => 'specialtie', 'label' => __('Especialidad')],
        ];

        return view('livewire.pages.grups.show', [
            'headers' => $headers,
            'students' => $this->students(),
        ]);
    }
}
