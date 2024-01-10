<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $super_admin = Role::create(['name' => 'superadmin']);

        $permissions = [
            [
                'group_name' => 'permission',
                'permissions' => [
                    'permission.menu',
                    'add.permission',
                    'edit.permission',
                    'delete.permission'
                ],

            ],
            [
                'group_name' => 'role',
                'permissions' => [
                    'role.menu',
                    'add.role',
                    'edit.role',
                    'delete.role'
                ],
            ],
            [
                'group_name' => 'role_in_permission',
                'permissions' => [
                    'add.role_in_permission',
                    'all.role_in_permission',
                    'edit.role_in_permission',
                    'delete.role_in_permission'
                ],
            ],
            [
                'group_name' => 'user',
                'permissions' => [
                    'all.user_menu',
                    'add.user',
                    'edit.user',
                    'delete.user'
                ],
            ],
        ];

        //create and assign permission===//
        $user = User::first();
        for($i = 0; $i < count($permissions);$i++){
            $permission_groups = $permissions[$i]['group_name'];
            
            for($j = 0; $j < count($permissions[$i]['permissions']);$j++){
                $permission = Permission::create(['name'=>$permissions[$i]['permissions'][$j],'group_name'=>$permission_groups]);

                $super_admin->givePermissionTo($permission);
                
                $user->assignRole($super_admin);
            }

        }
    }
}
