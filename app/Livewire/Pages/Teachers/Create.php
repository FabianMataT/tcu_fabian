<?php

namespace App\Livewire\Pages\Teachers;

use App\Models\Position;
use App\Models\User;
use Mary\Traits\Toast;
use Livewire\Component;
use App\Models\Teacher;
use Spatie\Permission\Models\Role;

class Create extends Component
{
    use Toast;

    public String $first_name, $middle_name, $last_name1, $last_name2, $email, $phone, $role_name;
    public int $selectedPosition;
    public $roles, $positions = [];

    protected $rules = [
        'first_name' => 'required|string|max:50',
        'middle_name' => 'nullable|string|max:50',
        'last_name1' => 'required|string|max:50',
        'last_name2' => 'required|string|max:50',
        'email' => 'required|string|email|max:50|unique:users,email',
        'phone' => 'required|string|max:20',
        'selectedPosition' => 'required|exists:positions,id',
        'role_name' => 'required|string|exists:roles,name',
    ];

    public function store()
    {
        $this->validate();

        $user = User::create([
            'name' => $this->first_name,
            'email' => $this->email,
            'password' => bcrypt($this->first_name . $this->phone),
        ]);
        $user->assignRole($this->role_name);

        Teacher::create([
            'first_name' => $this->first_name,
            'middle_name' => $this->middle_name ?? '',
            'last_name1' => $this->last_name1,
            'last_name2' => $this->last_name2,
            'email' => $this->email,
            'phone' => $this->phone,
            'user_id' => $user->id,
            'position_id' => $this->selectedPosition,
        ]);

        return $this->success(
            __('¡Creado exitosamente!'),
            __('Estas siendo redirigido.'),
            redirectTo: route('teachers.index')
        );
    }

    public function render()
    {
        $this->positions = Position::select('id', 'name')->get()->toArray();
        $this->roles = Role::select('name as role_name')->get()->toArray();

        return view('livewire.pages.teachers.create', [
            'positions' => $this->positions,
            'roles' => $this->roles,
        ]);
    }
}
