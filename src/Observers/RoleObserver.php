<?php

namespace Aweram\UserManagement\Observers;

use Aweram\UserManagement\Models\Role;

class RoleObserver
{
    public function deleted(Role $role)
    {
        $role->users()->sync([]);
        $role->permissions()->sync([]);
    }
}
