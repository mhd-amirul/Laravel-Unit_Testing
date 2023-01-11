<?php

use App\Http\Controllers\V1\auth\AppAuthController;
use Illuminate\Support\Facades\Route;

Route::get('/', fn () => "Laravel");
Route::redirect('about-page', 'page');

Route::get('page', fn () => "About");
Route::get('home', fn () => view("V1.pages.home"))->middleware("auth");

Route::controller(AppAuthController::class)->group(function () {
    Route::get("register", "create");
    Route::post("register", "store");

    Route::get('login', "login")->name("login");
    Route::post('login', "check");

    Route::post('logout', "logout")->middleware("auth");
});

