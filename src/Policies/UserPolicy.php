<?php

namespace Aweram\UserManagement\Policies;

use App\Models\User;
use Aweram\UserManagement\Interfaces\PolicyPermissionInterface;

class UserPolicy implements PolicyPermissionInterface
{
    const VIEW_ALL = 2;
    const CREATE = 4;
    const UPDATE = 8;
    const DELETE = 16;

    public static function getPermissions(): array
    {
        return [
            self::VIEW_ALL => __("View all"),
            self::CREATE => __("Creating"),
            self::UPDATE => __("Updating"),
            self::DELETE => __("Deleting")
        ];
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
