<?php

use App\Role;
use App\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::truncate();
//        factory(App\User::class, 10)->create();
        $role_admin = Role::whereRole(Role::ADMIN)->first();
        $role_client = Role::whereRole(Role::CLIENT)->first();
        $role_manager = Role::whereRole(Role::MANAGER)->first();
        User::create([
            'name' => 'admin@admin.com',
            'email' => 'admin@admin.com',
            'role_id' => $role_admin->id,
            'password' => Hash::make('admin@admin.com'),
        ]);
        User::create([
            'name' => 'client@client.com',
            'email' => 'client@client.com',
            'role_id' => $role_client->id,
            'password' => Hash::make('client@client.com'),
        ]);
        User::create([
            'name' => 'manager@manager.com',
            'email' => 'manager@manager.com',
            'role_id' => $role_manager->id,
            'password' => Hash::make('manager@manager.com'),
        ]);
    }
}
