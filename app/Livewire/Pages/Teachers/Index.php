<?php

namespace App\Livewire\Pages\Teachers;

use Mary\Traits\Toast;
use Livewire\Component;
use App\Models\Teacher;
use App\Models\User;
use Livewire\WithPagination;
use Illuminate\Pagination\LengthAwarePaginator;

class Index extends Component
{
    use WithPagination;
    use Toast;

    public bool $modalDeletConf = false;
    public $perPage = 10;
    public array $sortBy = ['column' => 'nombre', 'direction' => 'asc'];
    public string $search = '';
    public ?Teacher $teacher = null;
    public ?User $user = null;

    public function teachers(): LengthAwarePaginator
    {
        $query = Teacher::query()
            ->with(['position:id,name', 'user.roles'])
            ->when($this->search, function ($query) {
                $query->where(function ($q) {
                    $q->where('first_name', 'like', "%{$this->search}%")
                        ->orWhere('middle_name', 'like', "%{$this->search}%")
                        ->orWhere('last_name1', 'like', "%{$this->search}%")
                        ->orWhere('last_name2', 'like', "%{$this->search}%")
                        ->orWhere('email', 'like', "%{$this->search}%")
                        ->orWhereHas('position', fn($q) => $q->where('name', 'like', "%{$this->search}%"))
                        ->orWhereHas('user.roles', fn($q) => $q->where('roles.name', 'like', "%{$this->search}%"));
                });
            });
            
        $teachers = $query->get();

        $teachers = match ($this->sortBy['column']) {
            'rol' => $this->sortBy['direction'] === 'asc'
                ? $teachers->sortBy(fn($prof) => optional($prof->user->roles->first())->name)
                : $teachers->sortByDesc(fn($prof) => optional($prof->user->roles->first())->name),
            default => $this->sortBy['direction'] === 'asc'
                ? $teachers->sortBy($this->sortBy['column'])
                : $teachers->sortByDesc($this->sortBy['column']),
        };
        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $items = $teachers->slice(($currentPage - 1) * $this->perPage)->values();

        return new LengthAwarePaginator($items, $teachers->count(), $this->perPage, $currentPage);
    }

    public function deleteConf(Teacher $teacher): void
    {
        $this->teacher = $teacher;
        $this->modalDeletConf = true;
    }

    public function destroy(): void
    {
        if ($this->teacher) {
            $this->user = $this->teacher->user;
            $this->user->delete();
            $this->user = null;
            $this->teacher = null;
            $this->modalDeletConf = false;
            $this->success(__('¡Profesor eliminado exitosamente!'));
        }
    }

    public function render()
    {
        $headers = [
            ['key' => 'name', 'label' => __('Nombre')],
            ['key' => 'email', 'label' => __('Correo')],
            ['key' => 'position.name', 'label' => __('Puesto')],
            ['key' => 'rol', 'label' => __('Rol')],
        ];

        return view('livewire.pages.teachers.index', [
            'teachers' => $this->teachers(),
            'headers' => $headers
        ]);
    }
}
