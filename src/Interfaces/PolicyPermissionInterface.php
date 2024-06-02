<?php

namespace Aweram\UserManagement\Interfaces;

interface PolicyPermissionInterface
{
    public static function getPermissions(): array;

    public static function defaultPermissions(): int;
}
