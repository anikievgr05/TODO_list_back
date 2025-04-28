<?php

use App\Http\Controllers\RoleController;
use Illuminate\Support\Facades\Route;

Route::apiResource('role', RoleController::class)->only([
    'index', 'store'
]);
Route::group(['prefix' => 'role' , 'middleware' => 'role'], function () {
    Route::put('/closed/{role}', [RoleController::class, 'close'])->name('role.closed');
    Route::get('/{role}', [RoleController::class, 'show'])->name('role.show');
    Route::put('/{role}', [RoleController::class, 'update'])->name('role.update');
});
