<?php

namespace App\Livewire\Admin;

use App\Models\User;
use Livewire\Component;

class UsersEdit extends Component
{
    public $open = false;
    public $user,$userName,$userEmail;

    protected function rules()
    {
        return [
            'userName' => 'required|min:3',
            'userEmail' => 'required|unique:users,email,' . ($this->user->id ?? 'NULL'),
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

    public function mount(User $user)
    {
        $this->user = $user;
        $this->userName = $user->name;
        $this->userEmail = $user->email;
    }
    public function save()
    {
        $this->validate();

        // Actualiza las propiedades de la usuario
        $this->user->name = $this->userName;
        $this->user->email = $this->userEmail;

        // Guarda la categoría
        $this->user->save();

        // Reset the fields
        $this->reset(['open']);

        //Broadcast events
        $this->dispatch('refresh');
        $this->dispatch('alert', 'Sea  actualizado la usuario correctamente');
    }
    public function closeModal()
    {
        $this->open = false;

        // Resetea la validación
        $this->resetValidation();
    }

    public function render()
    {
        return view('livewire.admin.users-edit');
    }
}
