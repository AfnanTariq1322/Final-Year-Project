<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Users\UsersController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', [UsersController::class, 'home'])->name('home');


Route::post('/user/save', [UsersController::class, 'save'])->name('user.save');
Route::post('/user/check', [UsersController::class, 'check'])->name('user.check');
Route::post('/user/logout', [UsersController::class, 'logout'])->name('user.logout');


Route::middleware(['web','AuthCheck'])->group(function () {

 
   
Route::get('/user/profile', [UsersController::class, 'profile'])->name('user.profile');
Route::get('/user/login', [UsersController::class, 'login'])->name('user.login');
Route::get('/user/profile', [UsersController::class, 'profile'])->name('user.profile');
Route::get('/user/register', [UsersController::class, 'register'])->name('user.register');
Route::get('/user/dashboard', [UsersController::class, 'dashboard'])->name('user.dashboard');
Route::get('/user/profileview', [UsersController::class, 'profileview'])->name('user.profileview');
Route::get('/user/profileedit', [UsersController::class, 'profileedit'])->name('user.profileedit');

 
}); 
