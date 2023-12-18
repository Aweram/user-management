<?php

use Illuminate\Support\Facades\Route;

Route::middleware(["web", 'auth'])
    ->prefix(config("user-management.prefix"))
    ->as(config("user-management.as"))
    ->group(function () {
        Route::get(config("user-management.pageUrl"), function () {
            return view("um::admin.users");
        })->name("users");
    });
