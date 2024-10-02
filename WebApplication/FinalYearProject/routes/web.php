<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Users\UsersController;
use App\Http\Controllers\Admins\AdminController;

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
Route::post('/profile/update', [UsersController::class, 'updateProfile'])->name('user.updateProfile');

Route::middleware(['web','AuthCheck'])->group(function () {

Route::get('/user/profile', [UsersController::class, 'profile'])->name('user.profile');
Route::get('/user/login', [UsersController::class, 'login'])->name('user.login');
Route::get('/user/register', [UsersController::class, 'register'])->name('user.register');
Route::get('/user/profile', [UsersController::class, 'profile'])->name('user.profile');

Route::get('/user/dashboard', [UsersController::class, 'dashboard'])->name('user.dashboard');
 
}); 








//Admin Panel Routes
Route::post('/admin/save', [AdminController::class, 'save'])->name('admin.save');
Route::post('/admin/check', [AdminController::class, 'check'])->name('admin.check');
Route::get('/admin/logout', [AdminController::class, 'logout'])->name('admin.logout');
 
Route::post('/admin/user/{id}/active', [AdminController::class, 'activate'])->name('user.active');
Route::post('/admin/user/{id}/inactive', [AdminController::class, 'deactivate'])->name('user.inactive');
Route::post('/admin/profile/update', [AdminController::class, 'updateProfile'])->name('admin.profile.update');
 
Route::middleware(['web','AuthCheck'])->group(function () {

    Route::get('/admin/register', [AdminController::class, 'register'])->name('admin.register');
    Route::get('/admin/login', [AdminController::class, 'login'])->name('admin.login');
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/admin/profile', [AdminController::class, 'profile'])->name('admin.profile');
    Route::get('/admin/blog', [AdminController::class, 'blog'])->name('admin.blog');
    Route::post('/admin/blogs/store', [AdminController::class, 'storeBlog'])->name('admin.blogs.store');
    Route::delete('/admin/blogs/{id}', [AdminController::class, 'destroyBlog'])->name('admin.blogs.destroy');
    Route::put('/admin/blogs/{id}', [AdminController::class, 'updateBlog'])->name('admin.blog.update');

    Route::get('/admin/category', [AdminController::class, 'category'])->name('admin.category');
    Route::post('/admin/category/add', [AdminController::class, 'addCategory'])->name('category.add');
    Route::delete('/admin/category/{id}', [AdminController::class, 'deleteCategory'])->name('category.delete');
    Route::put('/admin/category/{id}', [AdminController::class, 'updateCategory'])->name('category.update');

}); 

