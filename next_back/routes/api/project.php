<?php
use App\Http\Controllers\ProjectController;
use Illuminate\Support\Facades\Route;

Route::apiResource('project', ProjectController::class)->only([
    'index', 'store', 'show', 'update'
]);
Route::get('/project/get_by_name/{project}', [ProjectController::class, 'get_by_name'])->name('project.get_by_name');
Route::put('/project/closed/{project}', [ProjectController::class, 'close'])->name('project.closed');
Route::get('/project/closed/{project}', [ProjectController::class, 'get_closed_project'])->name('project.get_closed_project');
