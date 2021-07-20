<?php

use App\User;
use App\Module;
use Laratrust\Models\LaratrustRole as Role;
use App\RoleUser;
use Laratrust\Models\LaratrustPermission as Permission;
use Illuminate\Database\Seeder;

class AdminSeederTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Module Setting
        $moduleSetting = Module::create([
            'name' => 'Module Setting'
        ]);

        $permissionModuleSetting = [
            [
                'name' => 'manage-setting',
                'display_name' => 'Manage Setting',
                'description' => 'Bisa Memanage Setting'
            ],
            [
                'name' => 'create-setting',
                'display_name' => 'Create Setting',
                'description' => 'Bisa Membuat Setting'
            ],
            [
                'name' => 'edit-setting',
                'display_name' => 'Edit Setting',
                'description' => 'Bisa Mengedit Setting'
            ]
        ];

        foreach ($permissionModuleSetting as $key) {
            # code...
            Permission::create([
                'name' => $key['name'],
                'display_name' => $key['display_name'],
                'description' => $key['description'],
                'module_id' => $moduleSetting->id
            ]);
        }

        $module = Module::create([
            'name' => 'Module'
        ]);

        $permissionModule = [
            [
                'name' => 'manage-module',
                'display_name' => 'Manage Module',
                'description' => 'Bisa Memanage Module'
            ],
            [
                'name' => 'create-module',
                'display_name' => 'Create Module',
                'description' => 'Bisa Membuat Module'
            ],
            [
                'name' => 'edit-module',
                'display_name' => 'Edit Module',
                'description' => 'Bisa Mengedit Module'
            ],
            [
                'name' => 'delete-module',
                'display_name' => 'Delete Module',
                'description' => 'Bisa Menghapus Module'
            ]
        ];

        foreach ($permissionModule as $key) {
            # code...
            Permission::create([
                'name' => $key['name'],
                'display_name' => $key['display_name'],
                'description' => $key['description'],
                'module_id' => $module->id
            ]);
        }

        // Permission
        $modulePermission = Module::create([
            'name' => 'Module Permission'
        ]);

        $permissionModulePermission = [
            [
                'name' => 'manage-permission',
                'display_name' => 'Manage Permission',
                'description' => 'Bisa Memanage Permission'
            ],
            [
                'name' => 'edit-permission',
                'display_name' => 'Edit Permission',
                'description' => 'Bisa Mengedit Permission'
            ]
        ];

        foreach ($permissionModulePermission as $key) {
            # code...
            Permission::create([
                'name' => $key['name'],
                'display_name' => $key['display_name'],
                'description' => $key['description'],
                'module_id' => $modulePermission->id
            ]);
        }

        // Pengguna
        $moduleUser = Module::create([
            'name' => 'Module User'
        ]);

        $permissionModuleUser = [
            [
                'name' => 'manage-user',
                'display_name' => 'Manage User',
                'description' => 'Bisa Memanage User'
            ],
            [
                'name' => 'create-user',
                'display_name' => 'Create User',
                'description' => 'Bisa Membuat User'
            ],
            [
                'name' => 'edit-user',
                'display_name' => 'Edit User',
                'description' => 'Bisa Mengedit User'
            ],
            [
                'name' => 'reset-password',
                'display_name' => 'Reset Password User',
                'description' => 'Bisa Mengganti Password User'
            ],
            [
                'name' => 'manage-account',
                'display_name' => 'Manage Account Profile',
                'description' => 'Bisa Memanage Profile'
            ],
            [
                'name' => 'edit-account',
                'display_name' => 'Edit Account Profile',
                'description' => 'Bisa Mengedit Profile'
            ],
            [
                'name' => 'change-password-account',
                'display_name' => 'Reset Password Profile',
                'description' => 'Bisa Mengganti Password Profile'
            ],
        ];

        foreach ($permissionModuleUser as $key) {
            # code...
            Permission::create([
                'name' => $key['name'],
                'display_name' => $key['display_name'],
                'description' => $key['description'],
                'module_id' => $moduleUser->id
            ]);
        }

        // Module Role
        $moduleRole = Module::create([
            'name' => 'Module Role'
        ]);

        $permissionModuleRole = [
            [
                'name' => 'manage-role',
                'display_name' => 'Manage Role',
                'description' => 'Bisa Memanage Role'
            ],
            [
                'name' => 'create-role',
                'display_name' => 'Create Role',
                'description' => 'Bisa Membuat Role'
            ],
            [
                'name' => 'edit-role',
                'display_name' => 'Edit Role',
                'description' => 'Bisa Mengedit Role'
            ]
        ];

        foreach ($permissionModuleRole as $key) {
            # code...
            Permission::create([
                'name' => $key['name'],
                'display_name' => $key['display_name'],
                'description' => $key['description'],
                'module_id' => $moduleRole->id
            ]);
        }

        // Administrator Rules
        Role::create([
            'name' => 'admin',
            'display_name' => 'Administrator',
            'description' => 'Ini adalah Role Admin'
        ]);

        $adminRole = Role::where('name', 'admin')->first();
        $adminPermission = [
            'manage-setting',
            'create-setting',
            'manage-module',
            'create-module',
            'edit-module',
            'delete-module',
            'manage-permission',
            'edit-permission',
            'manage-user',
            'create-user',
            'edit-user',
            'reset-password',
            'manage-account',
            'edit-account',
            'change-password-account',
            'manage-role',
            'create-role',
            'edit-role'
        ];

        $userAdmin = User::create([
            'name' => 'Aulia Rahman',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('123456')
        ]);

        foreach ($adminPermission as $key => $ap) {
            # code...
            $permission = Permission::where('name', $ap)->first();
            $adminRole->attachPermission($permission->id);
        }

        $userAdmin->attachRole($adminRole);


        // Operator
        Role::create([
            'name' => 'user',
            'display_name' => 'User',
            'description' => 'Ini adalah Role User'
        ]);

        $operatorRole = Role::where('name', 'user')->first();
        $operatorPermission = [
            'manage-setting',
        ];

        $operatorUser = User::create([
            'name' => 'Test',
            'email' => 'test@gmail.com',
            'password' => bcrypt('123456')
        ]);

        foreach ($operatorPermission as $key => $ap) {
            # code...
            $permission = Permission::where('name', $ap)->first();
            $operatorRole->attachPermission($permission->id);
        }

        $operatorUser->attachRole($operatorUser);
    }
}
