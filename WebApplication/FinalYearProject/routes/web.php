<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Users\UsersController;
use App\Http\Controllers\Admins\AdminController;
use App\Http\Controllers\Dashboard\DoctorController;  // ← updated controller name
use App\Http\Controllers\Blogs\BlogController;
use App\Http\Controllers\Newsletter\NewsletterController;
use App\Http\Controllers\Contact\ContactController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\Dashboard\UserController;

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
Route::get('/doctors', [UsersController::class, 'doctors'])->name('doctors');
Route::get('/blogs', [UsersController::class, 'blogs'])->name('blogs');
Route::get('/blog/{id}', [UsersController::class, 'showBlog'])->name('blogdetail');
Route::get('/blogs/{id}', [UsersController::class, 'filterBlogsByCategory'])->name('blogs.filter');
Route::post('/blogs/{blog}/comments', [BlogController::class, 'storeComment'])->name('comments.store');
Route::get('/doctor/{id}', [UsersController::class, 'doctorProfile'])->name('doctor.public.profile');

Route::post('/user/save', [UsersController::class, 'save'])->name('user.save');
Route::post('/user/check', [UsersController::class, 'check'])->name('user.check');
Route::post('/user/logout', [UsersController::class, 'logout'])->name('user.logout');
Route::post('/profile/update', [UsersController::class, 'updateProfile'])->name('user.updateProfile');
Route::post('/user/save', [UsersController::class, 'save'])->name('user.save');

//Route::middleware(['web','AuthCheck'])->group(function () {
    Route::get('/user/profile', [UsersController::class, 'profile'])->name('user.profile');
    Route::get('/user/login', [UsersController::class, 'login'])->name('user.login');
    Route::get('/user/register', [UsersController::class, 'register'])->name('user.register');
    Route::get('/user/profile', [UsersController::class, 'profile'])->name('user.profile');
    Route::get('/user/dashboard', [UsersController::class, 'dashboard'])->name('user.dashboard');
    Route::get('/user/appointments', [UsersController::class, 'appointments'])->name('user.appointments');
    Route::get('/user/download-appointment/{id}', [UsersController::class, 'downloadAppointmentPDF'])->name('user.download.appointment');
    Route::post('/verify-otp', [UsersController::class, 'verifyOtp'])->name('user.verifyOtp');
    Route::post('/resend-otp', [UsersController::class, 'resendOtp'])->name('user.resendOtp');
    Route::post('/forgot-password', [UsersController::class, 'sendResetLink'])->name('user.forgotPassword');
    Route::get('/reset-password/{token}', [UsersController::class, 'showResetForm'])->name('password.reset');
    Route::post('/reset-password', [UsersController::class, 'resetPassword'])->name('password.update');
//});

// Doctor Routes
Route::post('/doctor/save', [DoctorController::class, 'save'])->name('doctor.save');
Route::post('/doctor/check', [DoctorController::class, 'check'])->name('doctor.check');
Route::get('/doctor_logout', [DoctorController::class, 'logout'])->name('doctor.logout');
Route::get('/doctor/verify', [DoctorController::class, 'verify'])->name('doctor.verify');
Route::post('/verify-otp', [DoctorController::class, 'verifyOtp'])->name('doctor.verify.otp');
Route::post('/resend-otp', [DoctorController::class, 'resendOtp'])->name('doctor.resend.otp');
Route::get('/register', [DoctorController::class, 'register'])->name('doctor.register');
Route::get('/login', [DoctorController::class, 'login'])->name('doctor.login');
Route::get('/doctor_dashboard', [DoctorController::class, 'dashboard'])->name('doctor.dashboard');
Route::get('/doctor_profile', [DoctorController::class, 'profile'])->name('doctor.profile');
Route::get('/doctor_appointments', [DoctorController::class, 'appointments'])->name('doctor.appointments');
Route::get('/doctor_completedappointments', [DoctorController::class, 'completedappointments'])->name('doctor.completedappointments');
Route::get('/doctor_fundus-analysis', [DoctorController::class, 'fundusAnalysis'])->name('doctor.fundus.analysis');

 Route::post('/add', [DoctorController::class, 'save'])->name('add');

Route::middleware(['web', 'AuthCheck'])->group(function () {
     Route::post('/doctor/profile/update', [DoctorController::class, 'updateProfile'])->name('doctor.profile.update');
 });
Route::post('/doctor/complete-appointment/{id}', [DoctorController::class, 'completeAppointment'])->name('doctor.complete.appointment');
Route::get('/doctor/download-appointment/{id}', [DoctorController::class, 'downloadAppointmentPDF'])->name('doctor.download.appointment');
Route::post('/doctor/analyze-fundus', [DoctorController::class, 'analyzeFundus'])->name('doctor.analyze.fundus');

//Admin Panel Routes
Route::post('/admin/save', [AdminController::class, 'save'])->name('admin.save');
Route::post('/admin/check', [AdminController::class, 'check'])->name('admin.check');
Route::get('/admin/logout', [AdminController::class, 'logout'])->name('admin.logout');
 
Route::post('/admin/user/{id}/active', [AdminController::class, 'activate'])->name('user.active');
Route::post('/admin/user/{id}/inactive', [AdminController::class, 'deactivate'])->name('user.inactive');
Route::post('/admin/profile/update', [AdminController::class, 'updateProfile'])->name('admin.profile.update');
 
//Route::middleware(['web','AuthCheck'])->group(function () {

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

    // Doctors Management Routes
    Route::get('/admin/doctors', [AdminController::class, 'doctors'])->name('admin.doctors');
    Route::post('/admin/doctor/activate/{id}', [AdminController::class, 'activateDoctor'])->name('admin.doctor.activate');
    Route::post('/admin/doctor/deactivate/{id}', [AdminController::class, 'deactivateDoctor'])->name('admin.doctor.deactivate');

//}); 

Route::post('/subscribe-newsletter', [NewsletterController::class, 'subscribe']);
Route::get('/confirm-subscription', [NewsletterController::class, 'confirmSubscription']);

// Doctor profile and appointment routes
Route::post('/appointment/request', [AppointmentController::class, 'requestAppointment'])->name('appointment.request');
Route::get('/appointments', [AppointmentController::class, 'getAppointments'])->name('appointments.index');

Route::get('/test-route', [TestController::class, 'test'])->name('test.route');

Route::post('/appointments/{id}/update-status', [DoctorController::class, 'updateAppointmentStatus'])->name('appointment.update-status');

Route::post('/user/analyze-fundus', [UserController::class, 'analyzeFundus'])->name('user.analyze.fundus');
// Doctor routes
Route::middleware(['web', 'AuthCheck'])->group(function () {
    Route::get('/doctor/download-user-report/{id}', [DoctorController::class, 'downloadUserReport'])->name('doctor.download.user.report');
});

// User Routes
Route::prefix('user')->group(function () {
    Route::get('/login', [UsersController::class, 'login'])->name('user.login');
    Route::get('/register', [UsersController::class, 'register'])->name('user.register');
    Route::post('/save', [UsersController::class, 'save'])->name('user.save');
    Route::post('/check', [UsersController::class, 'check'])->name('user.check');
    Route::post('/verify-otp', [UsersController::class, 'verifyOtp'])->name('user.verify.otp');
    Route::post('/resend-otp', [UsersController::class, 'resendOtp'])->name('user.resend.otp');
    Route::get('/profile', [UsersController::class, 'profile'])->name('user.profile');
    Route::get('/dashboard', [UsersController::class, 'dashboard'])->name('user.dashboard');
    Route::get('/appointments', [UsersController::class, 'appointments'])->name('user.appointments');
    Route::get('/download-appointment/{id}', [UsersController::class, 'downloadAppointmentPDF'])->name('user.download.appointment');
    Route::post('/profile/update', [UsersController::class, 'updateProfile'])->name('user.updateProfile');
    Route::post('/logout', [UsersController::class, 'logout'])->name('user.logout');
});

