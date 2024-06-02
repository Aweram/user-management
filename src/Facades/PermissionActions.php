<?php

namespace Aweram\UserManagement\Facades;

use Aweram\UserManagement\Helpers\PermissionActionsManager;
use Aweram\UserManagement\Models\Permission;
use Aweram\UserManagement\Models\Role;
use Illuminate\Support\Facades\Facade;

/**
 * @method static array getRightsListByRolePermission(Role $role, Permission $permission)
 * @method static void setPermissionByRoleRights(Role $role, Permission $permission, array $rightsList)
 *
 * @see PermissionActionsManager
 */
class PermissionActions extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return "permission-actions";
    }
}
