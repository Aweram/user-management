<?php

namespace Aweram\UserManagement;

use Aweram\UserManagement\Livewire\UserIndexWire;
use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;

class UserManagementServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        // Подключение views
        $this->loadViewsFrom(__DIR__ . "/resources/views", "um");

        // Livewire
        Livewire::component("um-users", UserIndexWire::class);
    }

    public function register(): void
    {
        // Подключение routes
        $this->loadRoutesFrom(__DIR__ . "/routes/admin.php");
    }
}
