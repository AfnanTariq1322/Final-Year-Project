<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Users\UsersController;
use App\Http\Controllers\Admins\AdminController;
use App\Http\Controllers\Blogs\BlogController;
use App\Http\Controllers\Newsletter\NewsletterController;
use App\Http\Controllers\Contact\ContactController;

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

Route::post('/contact-us', [ContactController::class, 'store'])->name('contact.store');

Route::get('/home', [UsersController::class, 'home'])->name('home');
Route::get('/about', [UsersController::class, 'about'])->name('about');
Route::get('/contact', [UsersController::class, 'contact'])->name('contact');
Route::get('/diagnosis', [UsersController::class, 'diagnosis'])->name('diagnosis');

Route::get('/blogs', [UsersController::class, 'blogs'])->name('blogs');
 Route::get('/blog/{id}', [UsersController::class, 'showBlog'])->name('blogdetail');
 Route::get('/blogs/{id}', [UsersController::class, 'filterBlogsByCategory'])->name('blogs.filter');
 Route::post('/blogs/{blog}/comments', [BlogController::class, 'storeComment'])->name('comments.store');


Route::post('/user/save', [UsersController::class, 'save'])->name('user.save');
Route::post('/user/check', [UsersController::class, 'check'])->name('user.check');
Route::post('/user/logout', [UsersController::class, 'logout'])->name('user.logout');
Route::post('/profile/update', [UsersController::class, 'updateProfile'])->name('user.updateProfile');
Route::post('/user/save', [UsersController::class, 'save'])->name('user.save');

Route::middleware(['web','AuthCheck'])->group(function () {

Route::get('/user/profile', [UsersController::class, 'profile'])->name('user.profile');
Route::get('/user/login', [UsersController::class, 'login'])->name('user.login');
Route::get('/user/register', [UsersController::class, 'register'])->name('user.register');
Route::get('/user/profile', [UsersController::class, 'profile'])->name('user.profile');

Route::get('/user/dashboard', [UsersController::class, 'dashboard'])->name('user.dashboard');
 
 Route::post('/verify-otp', [UsersController::class, 'verifyOtp'])->name('user.verifyOtp');
Route::post('/resend-otp', [UsersController::class, 'resendOtp'])->name('user.resendOtp');
Route::post('/forgot-password', [UsersController::class, 'sendResetLink'])->name('user.forgotPassword');
Route::get('/reset-password/{token}', [UsersController::class, 'showResetForm'])->name('password.reset');
Route::post('/reset-password', [UsersController::class, 'resetPassword'])->name('password.update');

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
    Route::get('/admin/user', [AdminController::class, 'user'])->name('admin.user');
    Route::get('/admin/contact', [AdminController::class, 'contact'])->name('admin.contact');

    Route::get('/admin/category', [AdminController::class, 'category'])->name('admin.category');
    Route::post('/admin/category/add', [AdminController::class, 'addCategory'])->name('category.add');
    Route::delete('/admin/category/{id}', [AdminController::class, 'deleteCategory'])->name('category.delete');
    Route::put('/admin/category/{id}', [AdminController::class, 'updateCategory'])->name('category.update');

}); 


 





Route::post('/subscribe-newsletter', [NewsletterController::class, 'subscribe']);
Route::get('/confirm-subscription', [NewsletterController::class, 'confirmSubscription']);
