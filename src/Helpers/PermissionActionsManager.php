<?php

namespace Aweram\UserManagement\Helpers;

use Aweram\UserManagement\Models\Permission;
use Aweram\UserManagement\Models\Role;

class PermissionActionsManager
{
    public function getRightsListByRolePermission(Role $role, Permission $permission): array
    {
        $currentPermission = $role->permissions()
            ->select("id", "policy")
            ->where("permission_id", $permission->id)
            ->first();

        $array = [];
        if ($currentPermission) {
            $rights = $currentPermission->pivot->rights;
            foreach ($currentPermission->policy::getPermissions() as $key => $value) {
                if ($rights & $key) $array[] = $key;
            }
        }
        return $array;
    }

    public function setPermissionByRoleRights(Role $role, Permission $permission, array $rightsList): void
    {
        $rights = 0;
        foreach ($rightsList as $item) {
            $rights += $item;
        }

        $exist = false;
        $role->load("permissions");
        foreach ($role->permissions as $item) {
            if ($item->key == $permission->key) {
                $exist = true;
                break;
            }
        }

        if ($exist)
            $role->permissions()->updateExistingPivot($permission->id, ["rights" => $rights]);
        else
            $role->permissions()->save($permission, ["rights" => $rights]);
    }
}
