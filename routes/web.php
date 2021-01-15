<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/appTopCategory',
            [\App\Http\Controllers\TopCategoryController::class,'getPositions']
            )->middleware(\App\Http\Middleware\EnsureDateIsValid::class);

Route::get('/error',[\App\Http\Controllers\ErrorController::class,'index']);
