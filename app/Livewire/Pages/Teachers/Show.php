<?php

namespace App\Livewire\Pages\Teachers;

use App\Models\User;
use App\Models\Teacher;
use Livewire\Component;
use Illuminate\Pagination\LengthAwarePaginator;
use Mary\Traits\Toast;

class Show extends Component
{
    use Toast;

    public bool $modalDeletConf, $modaldesativeConf, $modalActiveConf = false;
    public ?Teacher $teacher = null;
    public ?User $user = null;
    public $perPage = 10;
    public array $sortBy = ['column' => 'id', 'direction' => 'asc'];
    public string $search = '';

    public function subject_taughts(): LengthAwarePaginator
    {
        $subjects = $this->teacher
            ->subjects_taught_by_teacher()
            ->with([
                'subject:id,name',
                'subGrup:id,name,grup_id',
                'subGrup.grup:id,name,level_id',
                'subGrup.grup.level:id,name'
            ])
            ->when($this->search, function ($query) {
                $query->where(function ($q) {
                    $q->whereHas('subject', fn($q) => $q->where('name', 'like', '%' . $this->search . '%'))
                        ->orWhereHas('subGrup', fn($q) => $q->where('name', 'like', '%' . $this->search . '%'))
                        ->orWhereHas('subGrup.grup', fn($q) => $q->where('name', 'like', '%' . $this->search . '%'))
                        ->orWhereHas('subGrup.grup.level', fn($q) => $q->where('name', 'like', '%' . $this->search . '%'));
                });
            })
            ->get();

        $subjects = match ($this->sortBy['column']) {
            'subject' => $this->sortBy['direction'] === 'asc'
                ? $subjects->sortBy(fn($s) => optional($s->subject)->name)
                : $subjects->sortByDesc(fn($s) => optional($s->subject)->name),

            'subgrup' => $this->sortBy['direction'] === 'asc'
                ? $subjects->sortBy(fn($s) => optional($s->subGrup)->name)
                : $subjects->sortByDesc(fn($s) => optional($s->subGrup)->name),

            'grup' => $this->sortBy['direction'] === 'asc'
                ? $subjects->sortBy(fn($s) => optional($s->subGrup?->grup)->name)
                : $subjects->sortByDesc(fn($s) => optional($s->subGrup?->grup)->name),

            'level' => $this->sortBy['direction'] === 'asc'
                ? $subjects->sortBy(fn($s) => optional($s->subGrup?->grup?->level)->name)
                : $subjects->sortByDesc(fn($s) => optional($s->subGrup?->grup?->level)->name),

            default => $subjects
        };

        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $items = $subjects->slice(($currentPage - 1) * $this->perPage)->values();

        return new LengthAwarePaginator($items, $subjects->count(), $this->perPage, $currentPage);
    }

    public function activeAcount(): void
    {
        $user = User::create([
            'name' => $this->teacher->first_name,
            'email' => $this->teacher->email,
            'password' => bcrypt($this->teacher->first_name . $this->teacher->phone),
        ]);
        $this->teacher->update(['user_id' => $user->id]);
        $user->assignRole("Profesor nvl 1");
        $this->teacher->refresh();
        $this->modalActiveConf = false;
        $this->success(__('¡Cuenta activada exitosamente!'));
    }

    public function desactiveAcount(): void
    {
        if ($this->teacher && $this->teacher->user) {
            $this->teacher->update(['user_id' => null]);
            $this->teacher->user->delete();
            $this->user = null;
            $this->teacher->refresh();
            $this->modaldesativeConf = false;
            $this->success(__('¡Cuenta desactivada exitosamente!'));
        }
    }

    public function destroy()
    {
        $this->teacher->delete();
        $this->user = null;
        $this->teacher = null;
        $this->modalDeletConf = false;
        return $this->success(
            __('¡Profesor eliminado exitosamente!'),
            __('Estas siendo redirigido.'),
            redirectTo: route('teachers.index')
        );
    }


    public function render()
    {
        $headers = [
            ['key' => 'subject', 'label' => 'Materia'],
            ['key' => 'grup', 'label' => 'Grupo'],
            ['key' => 'subgrup', 'label' => 'Subgrupo'],
            ['key' => 'level', 'label' => 'Nivel'],
        ];

        return view('livewire.pages.teachers.show', [
            'headers' => $headers,
            'subjects' => $this->subject_taughts()
        ]);
    }
}
