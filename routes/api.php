<?php

use App\Http\Controllers\Api\fashionController;
use Illuminate\Http\Request;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
// Route::get('fashion',[fashionController::class, 'index']);
// Route::get('fashion/{id}',[fashionController::class, 'show']);
// Route::post('fashion',[fashionController::class, 'store']);
// Route::put('fashion/{id}',[fashionController::class, 'update']);
// Route::delete('fashion/{id}',[fashionController::class, 'destroy']);

Route::apiResource('fashion',fashionController::class); 