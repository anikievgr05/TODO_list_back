<?php
use App\Http\Controllers\ProjectController;
use Illuminate\Support\Facades\Route;

Route::apiResource('project', ProjectController::class)->only([
    'index', 'store', 'show', 'update'
]);;
Route::put('/project/{project}/close', [ProjectController::class, 'close']);
Route::get('/project/{project}/close', [ProjectController::class, 'get_closed_project']);
