<?php

use Illuminate\Support\Facades\Route;

use App\Http\Middleware\Authenticate;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\TaskController;



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

Route::get('/', [LoginController::class, 'login'])
    ->name('login');

Route::post('/singin', [LoginController::class, 'authenticate'])
    ->name('singin');

Route::get('/logout', [LoginController::class, 'logout'])
    ->name('logout');

Route::get('/register', [RegisterController::class])
    ->name('register');

Route::get('/home', [HomeController::class, 'index'])
    ->name('home');

/**
 * TODO LIST ROUTES
 */
Route::get('/todolist', [TaskController::class, 'index'])
    ->name('todolist_index');
Route::post('/todolist', [TaskController::class, 'store'])
    ->name('todolist_store');
Route::delete('/todolist', [TaskController::class, 'destroy'])
    ->name('todolist_destroy');
