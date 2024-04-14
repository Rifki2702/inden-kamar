<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Models\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [AuthController::class, 'index'])->name('login');
Route::post('/login-proses', [AuthController::class, 'login_proses'])->name('login-proses');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::group(['prefix' => 'admin', 'middleware' => ['auth'], 'as' => 'admin.'], function () {
    Route::get('/dashboard', [HomeController::class, 'dashboard'])->name('dashboard');

    Route::get('/profile', [HomeController::class, 'profile'])->name('profile');
    Route::post('/updateProfile', [HomeController::class, 'updateProfile'])->name('updateProfile');

    Route::get('/indenkamar', [HomeController::class, 'indenkamar'])->name('indenkamar');
    Route::post('/filter', [HomeController::class, 'filter'])->name('filter');
    Route::post('/insertinden', [HomeController::class, 'insertinden'])->name('insertinden');
    Route::put('/updateinden/{id}', [HomeController::class, 'updateinden'])->name('updateinden');
    Route::delete('/deletedata/{id}', [HomeController::class, 'deletedata'])->name('deletedata');
    Route::get('/printdata', [HomeController::class, 'printdata'])->name('printdata');
    Route::put('/updateStatus/{id}', [HomeController::class, 'updateStatus'])->name('updateStatus');
    Route::get('/getStatusCounts', [HomeController::class, 'getStatusCounts'])->name('getStatusCounts');

    Route::get('/tambahuser', [HomeController::class, 'tambahuser'])->name('tambahuser');
    Route::post('/insertuser', [HomeController::class, 'insertuser'])->name('insertuser');
    Route::delete('/deleteUser/{id}', [HomeController::class, 'deleteUser'])->name('deleteUser');
    Route::put('/updatedata/{id}', [HomeController::class, 'updatedata'])->name('updatedata');
});
