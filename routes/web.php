<?php

use App\Http\Controllers\fashionController;
use App\Http\Controllers\Login1Controller;
use App\Http\Controllers\Login2Controller;
use App\Http\Controllers\LoginController;
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

Route::get('/', function () {
    return view('welcome');
});


Route::get('fashion', [fashionController::class, 'index']);
Route::get('fashion/create', [fashionController::class, 'create']); // Add this line for the create view
Route::post('fashion', [fashionController::class, 'store']);
Route::get('fashion/{id}/edit', [fashionController::class, 'edit']); // Corrected route for edit
Route::put('fashion/{id}', [fashionController::class, 'update']);
Route::delete('fashion/{id}', [fashionController::class, 'destroy']);


Route::resource('login2', Login2Controller::class);