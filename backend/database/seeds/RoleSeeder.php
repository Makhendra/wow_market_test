<?php

use App\Role;
use App\RolePermissions;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        RolePermissions::truncate();

        $service = app(\App\Services\PermissionsRoleService::class);
        $role = Role::firstOrCreate(['role' => Role::ADMIN]);
        $service->updateOrCreate($role, $this->permissionsAdmin());

        $role = Role::firstOrCreate(['role' => Role::CLIENT]);
        $service->updateOrCreate($role, $this->permissionsClient());

        $role = Role::firstOrCreate(['role' => Role::MANAGER]);
        $service->updateOrCreate($role, $this->permissionsManager());
    }

    /**
     * @return array
     */
    private function permissionsAdmin():array {
        $sections_permissions = [];
        foreach (RolePermissions::SECTIONS as $section) {
            foreach (RolePermissions::ACTIONS as $action) {
                $sections_permissions[$section][$action] = true;
            }
        }
        return $sections_permissions;
    }

    /**
     * @return array
     */
    private function permissionsClient():array {
        $sections_permissions = [];
        foreach (RolePermissions::SECTIONS as $section) {
            foreach (RolePermissions::ACTIONS as $action) {
                $sections_permissions[$section][$action] = $action == RolePermissions::ACTION_SHOW;
            }
        }
        return $sections_permissions;
    }

    /**
     * @return array
     */
    private function permissionsManager():array {
        $sections_permissions = [];
        foreach (RolePermissions::SECTIONS as $section) {
            foreach (RolePermissions::ACTIONS as $action) {
                $sections_permissions[$section][$action] = in_array($section, [
                    RolePermissions::SECTION_PRODUCTS,
                    RolePermissions::SECTION_PRICES,
                    RolePermissions::SECTION_STORES,
                ]);
            }
        }
        return $sections_permissions;
    }
}
