<?php

use Illuminate\Support\Facades\Route;

use App\Http\Middleware\Authenticate;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\TaskItemController;
use App\Http\Controllers\SearchController;



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



Route::get('/register', [RegisterController::class])
    ->name('register');

Route::get('/home', [HomeController::class, 'index'])
    ->name('home');



Route::get('/', [LoginController::class, 'login'])
    ->name('login');
    
Route::post('/auth', [LoginController::class, 'authenticate'])
    ->name('singin');

Route::get('/logout', [LoginController::class, 'logout'])
    ->name('logout');

/**
 * TASK ROUTES
 */
Route::post('/task/update', [TaskController::class, 'customUpdate'])
    ->name('custom_update');

Route::resource('task', TaskController::class);

Route::put('taskItem/{taskItem}', [TaskItemController::class, 'updateSingle'])
    ->name('update_single');

Route::put('taskItem/group/{id}', [TaskItemController::class, 'updateGroup'])
    ->name('update_group');

Route::get('search/{query}', [SearchController::class, 'search'])
    ->name('search');
