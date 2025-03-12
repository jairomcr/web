<?php

namespace App\Livewire\Admin;

use App\Models\User;
use Livewire\Component;
use Spatie\Permission\Models\Role;

class UsersEdit extends Component
{
    public $open = false;
    public $user,$userName,$userEmail;
    public $userRole = [];
    public $userId;
    public $roles;

    protected function rules()
    {
        return [
            'userName' => 'required|min:3',
            'userEmail' => 'required|unique:users,email,' . ($this->userId ?? 'NULL'),
        ];
    }
    protected function messages()
    {
        return [
            'userName.required' => 'El nombre del usuario es obligatorio.',
            'userName.min' => 'El nombre del usuario debe tener al menos :min caracteres.',
            'userEmail.required' => 'El correo del usuario es obligatorio.',
            'userEmail.unique' => 'El correo ya está en uso. Por favor, elige otro.',
        ];
    }

    public function mount($userId)
    {
        $this->userId = $userId;
        // Carga el usuario que se va a editar
        $user = User::find($this->userId);

        if ($user) {
            $this->userName = $user->name;
            $this->userEmail = $user->email;
            $this->userRole = $user->roles()->pluck('name')->toArray();
        } else {
            session()->flash('error', 'Usuario no encontrado.');
            $this->closeModal();
        }

        // Carga la lista de roles disponibles
        $this->roles = Role::all();

    }
    public function save()
    {
        $this->validate();

        $user = User::find($this->userId);

        if ($user) {
            // Actualiza las propiedades de la usuario
            $user->name = $this->userName;
            $user->email = $this->userEmail;
            $user->syncRoles($this->userRole);

            // Guarda la user
            $user->save();

            $this->closeModal();

            //Broadcast events
            $this->dispatch('refresh');
            $this->dispatch('alert', 'Sea  actualizado la usuario correctamente');
        } 
        
    }
    public function closeModal()
    {
        $this->open = false;

        // Resetea la validación
        $this->resetValidation();
    }

    public function render()
    {
        return view('livewire.admin.users-edit',);
    }
}
