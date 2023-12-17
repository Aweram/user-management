<?php

namespace Aweram\UserManagement;

use Illuminate\Support\ServiceProvider;

class UserManagementServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        // Подключение views
        $this->loadViewsFrom(__DIR__ . "/resources/views", "um");
    }

    public function register(): void
    {
        // Подключение routes
        $this->loadRoutesFrom(__DIR__ . "/routes/admin.php");
    }
}
