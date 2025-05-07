<?php

namespace App\Livewire\Pages\Positions;

use App\Models\Position;
use App\Models\Teacher;
use Livewire\Component;
use Illuminate\Pagination\LengthAwarePaginator;

class Show extends Component
{
    public $perPage = 10;
    public array $sortBy = ['column' => 'first_name', 'direction' => 'asc'];
    public string $search = '';
    public ?Position $position = null;

    public function teachersXPositions(): LengthAwarePaginator
    {
        if (!isset($this->sortBy['column'], $this->sortBy['direction'])) {
            $this->sortBy = ['direction' => 'asc'];
        }

        return Teacher::query()
            ->where('position_id', $this->position->id)
            ->when($this->search, function ($query) {
                $query->where(function ($q) {
                    $q->where('first_name', 'like', "%{$this->search}%")
                        ->orWhere('last_name1', 'like', "%{$this->search}%")
                        ->orWhere('last_name2', 'like', "%{$this->search}%");
                });
            })
            ->orderBy($this->sortBy['column'], $this->sortBy['direction'])
            ->paginate($this->perPage);
    }
    
    public function render()
    {
        $headers = [
            ['key' => 'id', 'label' => __('#')],
            ['key' => 'name', 'label' => __('Profecional')],
        ];

        return view('livewire.pages.positions.show', [
            'headers' => $headers,
            'teachersXPositions' => $this->teachersXPositions(),
        ]);
    }
}
