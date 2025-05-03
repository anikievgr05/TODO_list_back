<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::apiResource('user_project', UserController::class)->only([
    'index', 'store'
]);
Route::group(['prefix' => 'user_project' , 'middleware' => 'user'], function () {
    Route::get('/{user}', [UserController::class, 'show'])->name('user_project.show');
    Route::put('/{user}', [UserController::class, 'update'])->name('user_project.update');
    Route::put('fire/{user}', [UserController::class, 'fire'])->name('user_project.fire');
    Route::put('fire_all/{user}', [UserController::class, 'fire_all'])->name('user_project.fire_all');
});
