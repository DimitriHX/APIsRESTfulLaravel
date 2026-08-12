<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MenuViewController;

Route::get('/', [MenuViewController::class, 'index']);
Route::get('/menu', [MenuViewController::class, 'index']);
