<?php

namespace App\Livewire\Pages\Teachers;

use App\Models\Position;
use App\Models\User;
use Mary\Traits\Toast;
use Livewire\Component;
use App\Models\Teacher;
use Spatie\Permission\Models\Role;

class Edit extends Component
{
    use Toast;

    public ?User $user = null;
    public ?Teacher $teacher = null;
    public String $first_name, $middle_name, $last_name1, $last_name2, $email, $phone, $role_name;
    public int $selectedPosition;
    public $roles, $positions = [];

    protected $rules = [
        'first_name' => 'required|string|max:50',
        'middle_name' => 'string|max:50',
        'last_name1' => 'required|string|max:50',
        'last_name2' => 'required|string|max:50',
        'email' => 'required|string|email|max:50',
        'phone' => 'required|string|max:20',
        'selectedPosition' => 'required|exists:positions,id',
        'role_name' => 'required|string|exists:roles,name',
    ];

    public function mount():void
    {
        $this->user = $this->teacher->user;
        $this->first_name = $this->teacher->first_name;
        $this->middle_name = $this->teacher->middle_name;
        $this->last_name1 = $this->teacher->last_name1;
        $this->last_name2 = $this->teacher->last_name2;
        $this->email = $this->teacher->email;
        $this->phone = $this->teacher->phone;
        $this->role_name = $this->user->roles->first()->name ?? null;
        $this->selectedPosition = $this->teacher->position_id;
        $this->roles = Role::select('name as role_name')->get()->toArray();
    }

    public function update(){
        $this->validate();
        
        if ($this->role_name) {
            $this->user->syncRoles([$this->role_name]); 
        }

        $this->teacher->first_name = $this->first_name;
        $this->teacher->middle_name = $this->middle_name;
        $this->teacher->last_name1 = $this->last_name1;
        $this->teacher->last_name2 = $this->last_name2;
        $this->teacher->email = $this->email;
        $this->teacher->phone = $this->phone;
        $this->teacher->position_id = $this->selectedPosition;
        $this->teacher->save();

        return $this->success(
            __('Actualizado exitosamente!'),
            __('Estas siendo redirigido.'),
            redirectTo: route('teachers.index')
        );
    }
    
    public function render()
    {
        $this->positions = Position::select('id', 'name')->get()->toArray();
        
        return view('livewire.pages.teachers.edit', [
            'positions' => $this->positions,
        ]);
    }
}
