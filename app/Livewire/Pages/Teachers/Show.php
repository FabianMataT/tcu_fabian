<?php

namespace App\Livewire\Pages\Teachers;

use Livewire\Component;
use App\Models\Teacher;
use Illuminate\Pagination\LengthAwarePaginator;

class Show extends Component
{
    public ?Teacher $teacher = null;
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
