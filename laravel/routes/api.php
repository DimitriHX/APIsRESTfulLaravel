<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\MenuItemController;

Route::prefix('menu-items')->group(function () {
    Route::get('/', [MenuItemController::class, 'index']);
    Route::get('/{id}', [MenuItemController::class, 'show'])->whereNumber('id');
    Route::post('/', [MenuItemController::class, 'store']);
    Route::put('/{id}', [MenuItemController::class, 'update'])->whereNumber('id');
    Route::delete('/{id}', [MenuItemController::class, 'destroy'])->whereNumber('id');
    Route::get('/category/{category}', [MenuItemController::class, 'getByCategory']);
});
