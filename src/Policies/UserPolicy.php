<?php

namespace Aweram\UserManagement\Policies;

use App\Models\User;
use Aweram\UserManagement\Interfaces\PolicyPermissionInterface;

class UserPolicy implements PolicyPermissionInterface
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

    public function update(User $user, User $model): bool
    {
        return true;
    }

    public function delete(User $user, User $model): bool
    {
        return true;
    }
}
