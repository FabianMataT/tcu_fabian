<?php

namespace App\Livewire\Pages\LifeSkills;

use App\Models\LifeSkill;
use Mary\Traits\Toast;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Pagination\LengthAwarePaginator;

class Index extends Component
{
    use WithPagination, Toast;

    public bool $modalDeletConf = false;
    public $perPage = 10;
    public array $sortBy = ['column' => 'name', 'direction' => 'asc'];
    public string $search = '';
    public ?LifeSkill $skill = null;

    public function life_skills(): LengthAwarePaginator
    {
        if (!isset($this->sortBy['column'], $this->sortBy['direction'])) {
            $this->sortBy = ['direction' => 'asc'];
        }

        return LifeSkill::query()
            ->when($this->search, function ($query) {
                $query->where(function ($q) {
                    $q->where('name', 'like', "%{$this->search}%")
                        ->orWhere('description', 'like', "%{$this->search}%");
                });
            })
            ->orderBy($this->sortBy['column'], $this->sortBy['direction'])
            ->paginate($this->perPage);
    }

    public function deleteConf(LifeSkill $skill): void
    {
        $this->skill = $skill;
        $this->modalDeletConf = true;
    }

    public function destroy(): void
    {
        $this->modalDeletConf = false;
        if ($this->skill === null) {
            $this->error("No hay ninguna habilidad de desarrollo humano seleccionada.");
            return;
        }

        $this->skill->delete();
        $this->success(__('Eliminada exitosamente!'));
        $this->skill = null;
    }

    public function render()
    {
        $headers = [
            ['key' => 'name', 'label' => __('Nombre')],
            ['key' => 'description', 'label' => __('Descripción')],
        ];

        return view('livewire.pages.life-skills.index', [
            'headers' => $headers,
            'skills' => $this->life_skills(),
        ]);
    }
}
