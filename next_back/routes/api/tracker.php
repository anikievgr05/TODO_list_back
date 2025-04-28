<?php
use App\Http\Controllers\TrackerController;
use Illuminate\Support\Facades\Route;

Route::apiResource('tracker', TrackerController::class)->only([
    'index', 'store', 'show', 'update'
]);
Route::group(['prefix' => 'tracker'], function () {
    Route::put('/closed/{tracker}', [TrackerController::class, 'close'])->name('tracker.closed');
});
