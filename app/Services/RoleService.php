<?php

namespace App\Services;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Log;

class RoleService
{
    /**
     * Obtener todos los roles con sus permisos.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAllRoles()
    {
        return Role::with('permissions')->get();
    }

    /**
     * Crear un nuevo rol.
     *
     * @param array $data
     * @return Role
     */
    public function createRole(array $data)
    {
        return Role::create(['name' => $data['name']]);
    }

    /**
     * Actualizar un rol existente.
     *
     * @param int $roleId
     * @param array $data
     * @return Role
     */
    public function updateRole(int $roleId, array $data)
    {
        $role = Role::findOrFail($roleId);
        $role->update(['name' => $data['name']]);

        if (isset($data['selectedPermissions'])) {
            $role->syncPermissions($data['selectedPermissions']);
        }

        return $role;
    }

    /**
     * Eliminar un rol.
     *
     * @param int $roleId
     * @return void
     */
    public function deleteRole(int $roleId)
    {
        $role = Role::findOrFail($roleId);
        $role->delete();
    }

    /**
     * Obtener todos los permisos.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAllPermissions()
    {
        return Permission::all();
    }

    /**
     * Obtener un rol por su ID.
     *
     * @param int $roleId
     * @return Role
     */
    public function getRoleById(int $roleId)
    {
        return Role::with('permissions')->findOrFail($roleId);
    }
}
