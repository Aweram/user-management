<?php

namespace Aweram\UserManagement\Policies;

use App\Models\User;
use Aweram\UserManagement\Models\Role;

class RolePolicy
{
    public function viewAny(User $user): bool
    {
        return true;
    }

    public function create(User $user): bool
    {
        return true;
    }

    public function update(User $user, Role $role): bool
    {
        return true;
    }

    public function delete(User $user, Role $role): bool
    {
        return true;
    }
}
