<?php

namespace Aweram\UserManagement\Observers;

use App\Models\User;

class UserObserver
{
    public function deleted(User $user): void
    {
        $user->roles()->sync([]);
    }
}
