<?php

namespace App\Services;

use App\Role;
use App\RolePermissions;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class PermissionsRoleService
{
    /**
     * @param Role|null $role
     * @return Collection
     */
    public function getRolePermissions(?Role $role = null): Collection
    {
        $permissionsRole = $role ? RolePermissions::whereRoleId($role->id)->first() : null;
        if (!$permissionsRole) {
            $permissionsRole = $this->updateOrCreate($role);
        }
        $permissions_data = $this->generatePermissionsArray($permissionsRole->permissions_info ?? []);
        return collect($permissions_data);
    }

    /**
     * @param Role|null $role
     * @param array $permissions
     * @return Model|RolePermissions
     */
    public function updateOrCreate(?Role $role, array $permissions = [])
    {
        $permissions_info = $this->generatePermissionsArray($permissions);
        if (empty($role)) {
            return new RolePermissions();
        } else {
            $rolePermissions = RolePermissions::firstOrCreate(['role_id' => $role->id]);
            $rolePermissions->permissions_info = $permissions_info;
            $rolePermissions->save();
            return $rolePermissions;
        }
    }

    /**
     * @param array $allowedPermissions
     * @return array
     */
    public function generatePermissionsArray(array $allowedPermissions = []): array
    {
        $sections_permissions = [];
        foreach (RolePermissions::SECTIONS as $section) {
            foreach (RolePermissions::ACTIONS as $action) {
                $isEnabled = $allowedPermissions[$section][$action] ?? false;
                $sections_permissions[$section][$action] = $isEnabled == '1';
            }
        }
        return $sections_permissions;
    }

}