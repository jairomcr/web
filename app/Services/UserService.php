<?php

namespace App\Services;

use App\Models\User;
use Spatie\Permission\Models\Role;

class UserService
{
    /**
     * Create a new class instance.
     */
    public function getPaginationUsers($search = '', $perPage = 8)
    {
        return User::where('name', 'LIKE', '%' . $search . '%')
            ->orWhere('email', 'LIKE', '%' . $search . '%')
            ->latest('id')
            ->paginate($perPage);
    }
    public function getUserById($userId)
    {
        return User::find($userId);
    }
    public function getAllRoles()
    {
        return Role::all(); 
    }
    public function updateUser($userId, $name,$email,$roles)
    {
        $user = User::find($userId);

        if ($user) {
            $user->name = $name;
            $user->email = $email;
            $user->syncRoles($roles);
            $user->save();
        }
    }
    public function deleteUser($userId)
    {
        $user = User::find($userId)->first();
        $user->delete();
    }
}
