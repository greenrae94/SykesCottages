<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\PropertyController;

Route::get('/', [PropertyController::class, 'index']);
Route::get('/search', [PropertyController::class, 'search']);
