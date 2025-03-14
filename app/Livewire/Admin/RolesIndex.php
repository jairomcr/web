<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Services\RoleService; 
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
    protected $roleService;

    public function __construct()
    {
        $this->roleService = new RoleService();
    }

    public function mount()
    {
        $this->roles = $this->roleService->getAllRoles();
        $this->permissions = $this->roleService->getAllPermissions();
    }

    public function render()
    {
        return view('livewire.admin.roles-index');
    }

    public function saveRole()
    {
        $this->validate();

        try {
            $this->roleService->createRole(['name' => $this->name]);

            $this->reset(['name']);
            session()->flash('message', 'Rol creado correctamente.');
        } catch (\Exception $e) {
            session()->flash('error', 'Error al crear el rol: ' . $e->getMessage());
        }

        $this->roles = $this->roleService->getAllRoles();
    }

    public function editRole($roleId)
    {
        $role = $this->roleService->getRoleById($roleId);
        $this->name = $role->name;
        $this->selectedRoleId = $roleId;
        $this->selectedPermissions = $role->permissions->pluck('id')->toArray();
    }

    public function updateRole()
    {
        $role = $this->roleService->getRoleById($this->selectedRoleId);
        $this->rules['name'] = 'required|string|max:255|unique:roles,name,' . $role->id;
        $this->validate();

        $existingPermissions = Permission::whereIn('id', $this->selectedPermissions)->pluck('id')->toArray();
        $this->selectedPermissions = $existingPermissions;

        try {
            $this->roleService->updateRole($this->selectedRoleId, [
                'name' => $this->name,
                'selectedPermissions' => $this->selectedPermissions,
            ]);

            $this->reset(['name', 'selectedRoleId', 'selectedPermissions']);
            session()->flash('message', 'Rol actualizado correctamente.');
        } catch (\Exception $e) {
            session()->flash('error', 'Error al actualizar el rol: ' . $e->getMessage());
        }

        $this->roles = $this->roleService->getAllRoles();
    }

    public function confirmDelete($roleId)
    {
        $this->roleIdToDelete = $roleId;
    }

    public function deleteRole()
    {
        try {
            $this->roleService->deleteRole($this->roleIdToDelete);
            session()->flash('message', 'Rol eliminado correctamente.');
        } catch (\Exception $e) {
            session()->flash('error', 'Error al eliminar el rol: ' . $e->getMessage());
        }

        $this->roles = $this->roleService->getAllRoles();
        $this->roleIdToDelete = null;
    }
}
