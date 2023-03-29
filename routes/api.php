<?php

use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\EnsureUUIDIsValid;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::prefix("users")->group(function () {

    Route::post("", [UserController::class, 'store']);

    Route::get("", [UserController::class, 'index']);

    Route::get("{id}", [UserController::class, 'show']);

    Route::delete("{id}", [UserController::class, 'destroy']);
});

Route::prefix("tasks")->group(function () {

    Route::post("", [TaskController::class, 'store']);

    Route::get("", [TaskController::class, 'index']) -> middleware(EnsureUUIDIsValid::class);

    Route::get("{id}", [TaskController::class, 'show']) -> middleware(EnsureUUIDIsValid::class);

    Route::delete("{id}", [TaskController::class, 'destroy'])->middleware(EnsureUUIDIsValid::class);;

    Route::put("{id}", [TaskController::class, 'update'])->middleware(EnsureUUIDIsValid::class);;
});
