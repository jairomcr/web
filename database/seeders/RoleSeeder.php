<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $role1 = Role::create(["name"=> "Admin"]);
        $role2 = Role::create(["name"=> "Blogger"]);

        Permission::create(['name' => 'admin.home', 'description'=>'Ver dashboard'])->syncRoles([$role1, $role2]);

        Permission::create(['name' => 'admin.users.index', 'description' => 'Ver usuarios'])->syncRoles([$role1]);

        Permission::create(['name'=> 'admin.categories.index', 'description' => 'Ver categorías'])->syncRoles([$role1, $role2]);
        

        Permission::create(['name' => 'admin.tags.index', 'description' => 'Ver tag'])->syncRoles([$role1, $role2]);
        

        Permission::create(['name' => 'admin.posts.index', 'description' => 'Ver artículos'])->syncRoles([$role1, $role2]);
        

        Permission::create(['name' => 'admin.products.index', 'description' => 'Ver productos'])->syncRoles([$role1, $role2]);
        

        Permission::create(['name' => 'admin.settings.index', 'description' => 'Ver configuraciones'])->syncRoles([$role1]);
       
    }
}
