<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesIndex extends Component
{
    public $roles;
    public $name,$description;
    public $selectedRoleId;
    public $permissions;
    public $selectedPermissions = [];
    public $roleIdToDelete;

    protected $rules = [
        'name' => 'required|string|max:255|unique:roles,name',
        'selectedPermissions' => 'array',
        'selectedPermissions.*' => 'exists:permissions,id',
    ];

    protected $messages = [
        'name.required' => 'El nombre del rol es obligatorio.',
        'name.unique' => 'Ya existe un rol con este nombre.',
        'name.max' => 'El nombre del rol no puede tener más de 255 caracteres.',
        'selectedPermissions.*.exists' => 'Uno o más permisos seleccionados no son válidos.',
    ];

    public function mount()
    {
        $this->roles = Role::with('permissions')->get(); // Eager loading
        $this->permissions = Permission::all();
    }

    public function render()
    {
        return view('livewire.admin.roles-index');
    }

    public function saveRole()
    {
        $this->validate();

        try {
            Role::create(['name' => $this->name]);

            $this->reset(['name']);
            session()->flash('message', 'Rol creado correctamente.');
        } catch (\Exception $e) {
            session()->flash('error', 'Error al crear el rol: ' . $e->getMessage());
        }

        $this->roles = Role::with('permissions')->get();
    }

    public function editRole($roleId)
    {
        $role = Role::find($roleId);
        $this->name = $role->name;
        $this->selectedRoleId = $roleId;
        $this->selectedPermissions = $role->permissions->pluck('id')->toArray();
    }

    public function updateRole()
    {
        $role = Role::find($this->selectedRoleId);
        $this->rules['name'] = 'required|string|max:255|unique:roles,name,' . $role->id;
        $this->validate();

        $existingPermissions = Permission::whereIn('id', $this->selectedPermissions)->pluck('id')->toArray();
        $this->selectedPermissions = $existingPermissions;

        try {
            $role = Role::find($this->selectedRoleId);
            $role->update(['name' => $this->name]);
            $role->syncPermissions($this->selectedPermissions);

            $this->reset(['name', 'selectedRoleId', 'selectedPermissions']);
            session()->flash('message', 'Rol actualizado correctamente.');
        } catch (\Exception $e) {
            session()->flash('error', 'Error al actualizar el rol: ' . $e->getMessage());
        }

        $this->roles = Role::with('permissions')->get();
    }

    public function confirmDelete($roleId)
    {
        $this->roleIdToDelete = $roleId;
    }

    public function deleteRole()
    {
        try {
            Role::find($this->roleIdToDelete)->delete();
            session()->flash('message', 'Rol eliminado correctamente.');
        } catch (\Exception $e) {
            session()->flash('error', 'Error al eliminar el rol: ' . $e->getMessage());
        }

        $this->roles = Role::with('permissions')->get();
        $this->roleIdToDelete = null;
    }
}
