<?php

namespace App\Livewire\Pages\Roles;

use App\Models\Module;
use Mary\Traits\Toast;
use Livewire\Component;
use Spatie\Permission\Models\Role;

class Create extends Component
{
    use Toast;

    public $role_name;
    public array $permissions = [];

    protected $rules = [
        'role_name' => 'required|string|max:30',
        'permissions' => 'required|array|min:1'
    ];

    public function store()
    {
        $this->validate();
        $role = Role::create(['name' => $this->role_name, 'guard_name' => 'web']);
        $role->syncPermissions($this->permissions);

        return $this->success(
            __('¡Rol creado exitosamente!'),
            __('Estas siendo redirigido'),
            redirectTo: route('roles.index')
        );
    }

    public function render()
    {
        $modules = Module::with('permissions')->get();
        return view('livewire.pages.roles.create', [
            'modules' => $modules,
        ]);
    }
}
