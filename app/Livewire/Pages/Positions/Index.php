<?php

namespace App\Livewire\Pages\Positions;

use App\Models\Position;
use App\Models\Puesto;
use Mary\Traits\Toast;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Pagination\LengthAwarePaginator;

class Index extends Component
{
    use WithPagination, Toast;

    public bool $modalDeletConf, $modalCreate, $modalEdit = false;
    public $perPage = 10;
    public array $sortBy = ['column' => 'id', 'direction' => 'asc'];
    public string $search = '';
    public String $name;
    public ?Position $position = null;

    protected $rules = [
        'name' => 'required|string|max:50',
    ];


    public function positions(): LengthAwarePaginator
    {
        if (!isset($this->sortBy['column'], $this->sortBy['direction'])) {
            $this->sortBy = ['direction' => 'asc'];
        }

        return Position::select(['id', 'name'])
            ->when(
                $this->search,
                fn($query) =>
                $query->where('name', 'like', "%{$this->search}%")
            )
            ->orderBy($this->sortBy['column'], $this->sortBy['direction'])
            ->paginate($this->perPage);
    }

    public function store()
    {
        $this->validate();

        Position::create([
            'name' => $this->name,
        ]);

        $this->modalCreate = false;
        $this->name = '';
        $this->success(__('Puesto Creado Exitosamnete!'));
    }

    public function edit(Position $position)
    {
        $this->position = $position;
        $this->name = $position->name;
        $this->modalEdit = true;
    }

    public function update()
    {
        $this->validate();
        $this->position->name = $this->name;
        $this->position->save();

        $this->modalEdit = false;
        $this->name = '';
        $this->success(__('Puesto Actualizado Exitosamnete!'));
    }

    public function deleteConf(Position $position): void
    {
        $this->position = $position;
        $this->modalDeletConf = true;
    }

    public function destroy(): void
    {
        $this->modalDeletConf = false;
        if ($this->position === null) {
            $this->error("No hay ningun puesto seleccionada.");
            return;
        }
        $this->position->delete();
        $this->success(__('Eliminado exitosamente!'));
        $this->position = null;
    }

    public function render()
    {
        $headers = [
            ['key' => 'id', 'label' => __('#')],
            ['key' => 'name', 'label' => __('Puesto')],
        ];

        return view('livewire.pages.positions.index', [
            'headers' => $headers,
            'positions' => $this->positions(),
        ]);
    }
}
