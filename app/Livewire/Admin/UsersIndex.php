<?php

namespace App\Livewire\Admin;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class UsersIndex extends Component
{
    use WithPagination;

    protected $paginationTheme = "bootstrap";

    public $search;
    public $userId;
    protected $listeners = ['refresh' => '$refresh', 'deleted'];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $users = User::where('name','LIKE','%'.$this->search . '%')
        ->orWhere('email','LIKE','%'.$this->search . '%')
        ->latest('id')
        ->paginate(8);

        return view('livewire.admin.users-index',compact('users'));
    }

    public function deleted($userId): void
    {
        $user = User::find($userId)->first();
        if ($user) {
            $user->delete();
            $this->dispatch('alert', 'Usuario eliminado correctamente.');
        } else {
            $this->dispatch('alert', 'Usuario no encontrado.');
        }
    }
}
