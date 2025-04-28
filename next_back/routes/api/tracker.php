<?php
use App\Http\Controllers\TrackerController;
use Illuminate\Support\Facades\Route;

Route::apiResource('tracker', TrackerController::class)->only([
    'index', 'store'
]);
Route::group(['prefix' => 'tracker' , 'middleware' => 'validate.trackerInProject'], function () {
    Route::put('/closed/{tracker}', [TrackerController::class, 'close'])->name('tracker.closed');
    Route::get('/{tracker}', [TrackerController::class, 'show'])->name('tracker.show');
    Route::put('/{tracker}', [TrackerController::class, 'update'])->name('tracker.update');
});
