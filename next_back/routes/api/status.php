<?php

use App\Http\Controllers\StatusContoller;
use Illuminate\Support\Facades\Route;

Route::apiResource('status', StatusContoller::class)->only([
    'index', 'store'
]);
Route::group(['prefix' => 'status' , 'middleware' => 'status'], function () {
    Route::put('/closed/{status}', [StatusContoller::class, 'close'])->name('status.closed');
    Route::put('/change_order/{status}/{action}', [StatusContoller::class, 'change_order'])->name('status.change_order');
    Route::get('/{status}', [StatusContoller::class, 'show'])->name('status.show');
    Route::put('/{status}', [StatusContoller::class, 'update'])->name('status.update');
});
