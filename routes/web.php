<?php

use App\Http\Controllers\TodoController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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
Auth::routes();

// Route::get('/', function () {
//     return view('welcome');
// });

Route::middleware(['auth'])->group(function () {
    Route::resource('todos', TodoController::class);
    Route::post('todos/{todo}/selesai', [TodoController::class, 'selesai'])->name('todos.selesai');
    Route::post('todos/{todo}/belum_selesai', [TodoController::class, 'belum_selesai'])->name('todos.belum_selesai');
});


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/', [TodoController::class, 'welcome'])->name('welcome');
