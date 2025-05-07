<?php

namespace App\Livewire\Pages\Roles;

use Mary\Traits\Toast;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Illuminate\Pagination\LengthAwarePaginator;

class Index extends Component
{
    use WithPagination, Toast;

    public bool $modalDeletConf = false;
    public $perPage = 10;
    public array $sortBy = ['column' => 'name', 'direction' => 'asc'];
    public string $search = '';

    public ?Role $role = null;

    public function roles(): LengthAwarePaginator
    {
        if (!isset($this->sortBy['column'], $this->sortBy['direction'])) {
            $this->sortBy = ['column' => 'name', 'direction' => 'asc'];
        }

        $rolesQuery = DB::table('roles')
            ->select(['id', 'name'])
            ->when($this->search, function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%');
            })
            ->orderBy($this->sortBy['column'], $this->sortBy['direction']);

        return $rolesQuery->paginate($this->perPage);
    }

    public function render()
    {
        $headers = [
            ['key' => 'id', 'label' => '#'],
            ['key' => 'name', 'label' => __('Role Name')]
        ];

        return view('livewire.pages.roles.index', [
            'roles' => $this->roles(),
            'headers' => $headers
        ]);
    }

    public function deleteConf($role): void
    {
        $this->role = Role::findOrFail($role);
        $this->modalDeletConf = true;
    }

    public function destroy(): void
    {
        if ($this->role) {
            $this->role->delete();
            $this->role = null;
            $this->modalDeletConf = false;
            $this->success(__('Rol eliminado exitosamente'));
        }
    }
}
