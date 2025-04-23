<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return response()->json([], 500);
});

require __DIR__.'/auth.php';
