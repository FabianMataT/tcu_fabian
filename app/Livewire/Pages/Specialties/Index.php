<?php

namespace App\Livewire\Pages\Specialties;

use App\Models\Specialtie;
use Illuminate\Support\Facades\Storage;
use Mary\Traits\Toast;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Pagination\LengthAwarePaginator;

class Index extends Component
{
    use WithPagination, Toast;

    public bool $modalDeletConf = false;
    public $perPage = 10;
    public array $sortBy = ['column' => 'acronym', 'direction' => 'asc'];
    public string $search = '';
    public ?Specialtie $specialtie = null;

    public function specialties(): LengthAwarePaginator
    {
        if (!isset($this->sortBy['column'], $this->sortBy['direction'])) {
            $this->sortBy = ['direction' => 'asc'];
        }

        return Specialtie::query()
            ->when($this->search, function ($query) {
                $query->where(function ($q) {
                    $q->where('acronym', 'like', "%{$this->search}%")
                        ->orWhere('name', 'like', "%{$this->search}%");
                });
            })
            ->orderBy($this->sortBy['column'], $this->sortBy['direction'])
            ->paginate($this->perPage);
    }

    public function clear()
    {
        $this->search = '';
    }

    public function deleteConf($specialtie): void
    {
        $this->specialtie = Specialtie::where('id', $specialtie)->first();
        $this->modalDeletConf = true;
    }

    public function destroy(): void
    {
        $this->modalDeletConf = false;
        if ($this->specialtie === null) {
            $this->error("No hay ninguna especialidad seleccionada.");
            return;
        }

        if ($this->specialtie->image_path && Storage::disk('public')->exists($this->specialtie->image_path)) {
            Storage::disk('public')->delete($this->specialtie->image_path);
        }

        $this->specialtie->delete();
        $this->success(__('Eliminada exitosamente!'));
        $this->specialtie = null;
    }

    public function render()
    {
        $headers = [
            ['key' => 'acronym', 'label' => __('Acrónimo')],
            ['key' => 'name', 'label' => __('Especialidad')],
        ];

        return view('livewire.pages.specialties.index', [
            'headers' => $headers,
            'specialties' => $this->specialties(),
        ]);
    }
}
