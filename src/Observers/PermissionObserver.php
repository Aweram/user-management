<?php

namespace Aweram\UserManagement\Observers;

use Aweram\UserManagement\Models\Permission;

class PermissionObserver
{
    public function deleted(Permission $permission)
    {
        $permission->roles()->sync([]);
    }
}
