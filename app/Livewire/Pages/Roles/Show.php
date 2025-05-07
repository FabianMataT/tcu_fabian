<?php

namespace App\Livewire\Pages\Roles;

use Mary\Traits\Toast;
use Livewire\Component;
use Livewire\WithPagination;
use Spatie\Permission\Models\Role;
use Illuminate\Pagination\LengthAwarePaginator;

class Show extends Component
{
    use WithPagination,  Toast;

    public ?Role $role = null;
    public $role_permission;
    public $perPage = 10;
    public array $sortBy = ['column' => 'module_name', 'direction' => 'asc'];
    public string $search = '';

    public function loadPermissions(): LengthAwarePaginator
    {
        if (!isset($this->sortBy['column'], $this->sortBy['direction'])) {
            $this->sortBy = ['column' => 'permissions.description', 'direction' => 'asc'];
        }

        $roleQuery = Role::with(['permissions.module'])
            ->where('roles.id', $this->role->id)
            ->when($this->search, function ($query) {
                $query->where('permissions.description', 'like', '%' . $this->search . '%')
                    ->orWhere('modules.name', 'like', '%' . $this->search . '%');
            })
            ->join('role_has_permissions', 'roles.id', '=', 'role_has_permissions.role_id')
            ->join('permissions', 'permissions.id', '=', 'role_has_permissions.permission_id')
            ->join('modules', 'modules.id', '=', 'permissions.module_id')
            ->where('role_has_permissions.role_id', $this->role->id)
            ->select('permissions.description as permission_description', 'modules.name as module_name')
            ->orderBy($this->sortBy['column'], $this->sortBy['direction']);

        return $roleQuery->paginate($this->perPage);
    }

    public function render()
    {
        $headers = [
            ['key' => 'module_name', 'label' => __('Modulos')],
            ['key' => 'description', 'label' => __('Permisos')]
        ];

        $roleName = Role::where('id', $this->role->id)->pluck('name')->first();

        return view('livewire.pages.roles.show', data: [
            'permissions' => $this->loadPermissions(),
            'headers' => $headers,
            'roleName' => $roleName,
        ]);
    }
}
