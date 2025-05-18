<?php

use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

Route::apiResource('task', TaskController::class)->only([
    'index', 'store'
]);
Route::group(['prefix' => 'task' , 'middleware' => 'task'], function () {
    Route::post('/{task}', [TaskController::class, 'update'])->name('task.update');
    Route::get('/{task}', [TaskController::class, 'show'])->name('task.show');
    Route::put('/{task}/change_status', [TaskController::class, 'change_status'])->name('task.change_status');
});
Route::delete('task/delete_file/{file}', [TaskController::class, 'delete_file'])->name('task.delete_file');
Route::get('task/get_file/{file}', [TaskController::class, 'get_file'])->name('task.get_file');
