<?php

namespace Aweram\UserManagement;

use App\Models\User;
use Aweram\UserManagement\Livewire\RoleIndexWire;
use Aweram\UserManagement\Livewire\UserIndexWire;
use Aweram\UserManagement\Observers\UserObserver;
use Aweram\UserManagement\Policies\UserPolicy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;

class UserManagementServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        // Подключение views
        $this->loadViewsFrom(__DIR__ . "/resources/views", "um");

        // Livewire
        // Users
        $component = config("user-management.customIndexComponent");
        Livewire::component(
            "um-users",
            $component ?? UserIndexWire::class
        );
        // Roles
        $component = config("user-management.customRoleIndexComponent");
        Livewire::component(
            "um-roles",
            $component ?? RoleIndexWire::class
        );

        // Policy
        if (config("user-management.usePolicy")) {
            Gate::policy(User::class, UserPolicy::class);
        }

        // Наблюдатели
        $userObserverClass = config("user-management.customUserObserver") ?? UserObserver::class;
        User::observe($userObserverClass);
    }

    public function register(): void
    {
        // Миграции.
        $this->loadMigrationsFrom(__DIR__ . "/database/migrations");

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
