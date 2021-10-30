<?php

use App\Http\Controllers\API\V1\HomeController;
use App\Http\Controllers\API\V1\SportController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::prefix('v1')->group(function () {
    Route::get('/', [HomeController::class, 'index']);

    Route::prefix('sports')->group(function () {
        Route::get('/', [SportController::class, 'index']);
    });
});
