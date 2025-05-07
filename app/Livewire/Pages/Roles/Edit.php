<?php

namespace App\Livewire\Pages\Roles;

use App\Models\Module;
use Livewire\Component;
use Spatie\Permission\Models\Role;
use Mary\Traits\Toast;

class Edit extends Component
{
    use Toast;

    public $role;
    public $role_name;
    public $permissions = []; 

    protected $rules = [
        'role_name' => 'required|string|max:30',
        'permissions' => 'required|array|min:1' 
    ];
    

    public function mount($role)
    {
        $this->role = $role;
        $this->loadRole();
    }

    public function loadRole()
    {
        $role = Role::findOrFail($this->role);
        $this->role_name = $role->name;
        $this->permissions = $role->permissions->pluck('name')->toArray();
    }

    public function update()
    {
        $this->validate();

        $role = Role::findOrFail($this->role);
        $role->name = $this->role_name;
        $role->save();
        $role->syncPermissions($this->permissions);
        
        return $this->success(
            __('¡Rol actualizado exitosamente!'),
            __('Estas siendo redirigido'),
            redirectTo: route('roles.index')
        );
    }


    public function render()
    {
        $modules = Module::with('permissions')->get();
        return view('livewire.pages.roles.edit', [
            'modules' => $modules,
        ]);
    }
}
