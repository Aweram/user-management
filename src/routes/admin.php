<?php

use Illuminate\Support\Facades\Route;

Route::middleware([
    "web", 'auth'
])->prefix("admin")->as("admin.")->group(function () {
    Route::get("/users", function () {
        return view("um::admin.users");
    })->name("users");
});
