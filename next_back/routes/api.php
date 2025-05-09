<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

});
// TODO перенести на верх
require __DIR__.'/api/project.php';
require __DIR__.'/api/user.php';
Route::group(['prefix' => '{project_id}', 'middleware' => 'validate.project'], function () {
    require __DIR__ . '/api/tracker.php';
    require __DIR__ . '/api/role.php';
    require __DIR__ . '/api/status.php';
    require __DIR__ . '/api/priority.php';
});
