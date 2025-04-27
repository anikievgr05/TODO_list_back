<?php
use App\Http\Controllers\TrackerController;
use Illuminate\Support\Facades\Route;

Route::apiResource('tracker', TrackerController::class)->only([
    'index', 'store', 'show', 'update'
]);
