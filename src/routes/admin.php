<?php

use Illuminate\Support\Facades\Route;

Route::middleware([
    "auth:sanctum"
])->group(function () {
    Route::get("/users", function () {
        return view("um::admin.users");
    })->name("users");
});
