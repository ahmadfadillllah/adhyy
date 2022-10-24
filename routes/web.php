<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\EnsureTokenIsValid;

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

Route::get('/', [DashboardController::class, 'home'])->name('home');

Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login/post', [AuthController::class, 'loginpost'])->name('login.post');

Route::get('/dashboard/index', [DashboardController::class, 'index'])->name('dashboard.index')->middleware('auth');
Route::post('/dashboard/index/post', [DashboardController::class, 'post'])->name('dashboard.post')->middleware('auth');
Route::post('/dashboard/index/update/{id}', [DashboardController::class, 'update'])->name('dashboard.update')->middleware('auth');
Route::get('/dashboard/index/delete/{id}', [DashboardController::class, 'delete'])->name('dashboard.delete')->middleware('auth');

