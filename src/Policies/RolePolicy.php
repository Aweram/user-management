<?php

namespace Aweram\UserManagement\Policies;

use App\Models\User;
use Aweram\UserManagement\Interfaces\PolicyPermissionInterface;
use Aweram\UserManagement\Models\Role;

class RolePolicy implements PolicyPermissionInterface
{

    public static function getPermissions(): array
    {
        return [];
    }

    public static function defaultPermissions(): int
    {
        return 0;
    }

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
