<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Permission;
use App\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        if ($this->command->confirm('Do you wish to insert settings, it will clear all old setting ?')) {
            $this->call(SettingsTableSeeder::class);
        }

        if ($this->command->confirm('Do you wish to add default permission ?')) {
            $permissions = Permission::defaultAdminPermissions();
            foreach ($permissions as $permission) {
                Permission::firstOrCreate([
                    'display_group' => $permission['group'],
                    'display_name' => $permission['name'],
                    'name' => $permission['role'],
                    'guard_name' => $permission['guard']
                ]);
            }

            $this->command->info('Default Permissions added.');
        }

        if ($this->command->confirm('Do you wish to add default role & admin ?')) {
            $roles_array = array('Superadmin');
            foreach($roles_array as $role) {
                $role = Role::firstOrCreate(['name' => trim($role), 'status' => 'Active', 'guard_name' => 'admin']);
                $role->syncPermissions(Permission::where('guard_name', 'admin')->get());
                $this->command->info('Role granted all the permissions');

                $input = [
                    'name' => 'Hiren Patel',
                    'email' => 'hiren123@gmail.com.com',
                    'email_verified_at' => date('Y-m-d H:i:s'),
                    'password' => bcrypt('123456'),
                    'status' => 'Active',
                    'created_at' => date('Y-m-d H:i:s')
                ];
                $user = \App\Models\Admin::create($input);        
                $user->assignRole($role->name);
            }
        }
    }
}
