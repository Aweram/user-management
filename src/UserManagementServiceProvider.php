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
        $component = config("user-management.customIndexComponent");
        Livewire::component(
            "um-users",
            $component ?? UserIndexWire::class
        );
    }

    public function register(): void
    {
        // Подключение конфигурации
        $this->mergeConfigFrom(
            __DIR__ . "/config/user-management.php", "user-management"
        );

        // Подключение routes
        $this->loadRoutesFrom(__DIR__ . "/routes/admin.php");

        // Подключение переводов
        $this->loadJsonTranslationsFrom(__DIR__ . "/lang");
    }
}
