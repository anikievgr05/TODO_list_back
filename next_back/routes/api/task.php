<?php

use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

Route::apiResource('task', TaskController::class)->only([
    'index', 'store'
]);
Route::group(['prefix' => 'task' , 'middleware' => 'task'], function () {
//    Route::put('/closed/{priority}', [PriorityContoller::class, 'close'])->name('priority.closed');
//    Route::put('/change_order/{priority}/{action}', [PriorityContoller::class, 'change_order'])->name('priority.change_order');
//    Route::get('/{priority}', [PriorityContoller::class, 'show'])->name('priority.show');
//    Route::put('/{priority}', [PriorityContoller::class, 'update'])->name('priority.update');
});
