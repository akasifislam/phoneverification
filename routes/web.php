<?php

use App\Http\Controllers\Backend\UserController;
use Illuminate\Support\Facades\Auth;
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


Route::get('user', [UserController::class, 'create']);
Route::post('user', [UserController::class, 'store'])->name('user.store');

Route::get('/verify', [UserController::class, 'getVerify'])->name('get.verify');
Route::post('/verify', [UserController::class, 'postVerify'])->name('post.verify');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
