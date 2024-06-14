<?php

use App\Http\Controllers\Api\fashionController as ApiFashionController;
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


Route::get('fashion/create', function() {
    return view('fashion.create');
});

Route::get('fashion', function() {
    return view('fashion.index');
});

Route::get('fashion/{id}/edit', function($id) {
    return view('fashion.edit', ['id' => $id]);
});
// Route::resource('fashion', ApiFashionController::class);
Route::delete('/fashion/{id}', [ApiFashionController::class, 'destroy'])->name('fashion.destroy');


// Route::get('/fashion', [ApiFashionController::class, 'index'])->name('fashion.index');
// Route::get('/fashion/create', [ApiFashionController::class, 'create'])->name('fashion.create');
// Route::get('/fashion/{id}/edit', [ApiFashionController::class, 'edit'])->name('fashion.edit');
// Route::get('/fashion/{id}', [ApiFashionController::class, 'show'])->name('fashion.show');

Route::resource('login2', Login2Controller::class);