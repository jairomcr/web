<?php

namespace App\Livewire\Admin;


use App\Services\UserService;
use Livewire\Component;


class UsersEdit extends Component
{
    public $open = false;
    public $user,$userName,$userEmail;
    public $userRole = [];
    public $userId;
    public $roles;
    protected $userService;

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
    
    public function __construct()
    {
        $this->userService = new UserService();
    }

    public function mount($userId)
    {
        $this->userId = $userId;
        // Carga el usuario que se va a editar
        $user = $this->userService->getUserById($this->userId);

        if ($user) {
            $this->userName = $user->name;
            $this->userEmail = $user->email;
            $this->userRole = $user->roles()->pluck('name')->toArray();
        } else {
            session()->flash('error', 'Usuario no encontrado.');
            $this->closeModal();
        }

        // Carga la lista de roles disponibles
        $this->roles = $this->userService->getAllRoles();

    }
    public function save()
    {
        $this->validate();

        $this->userService->updateUser(
            $this->userId,
            $this->userName,
            $this->userEmail,
            $this->userRole
        );

        $this->closeModal();

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
        return view('livewire.admin.users-edit',);
    }
}
