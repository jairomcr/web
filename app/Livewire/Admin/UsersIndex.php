<?php

namespace App\Livewire\Admin;


use App\Services\UserService;
use Livewire\Component;
use Livewire\WithPagination;

class UsersIndex extends Component
{
    use WithPagination;

    protected $paginationTheme = "bootstrap";

    public $search;
    public $userId;
    protected $listeners = ['refresh' => '$refresh', 'deleted'];

    protected $userService;

    public function __construct()
    {
        $this->userService = new UserService();
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $users = $this->userService->getPaginationUsers($this->search);
        return view('livewire.admin.users-index',compact('users'));
    }

    public function deleted($userId): void
    {
        $this->userService->deleteUser($userId);
        $this->dispatch('alert', 'Usuario eliminado correctamente.');
        
    }
}
