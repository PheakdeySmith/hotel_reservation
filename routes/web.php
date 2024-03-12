<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\CustomerTypeController;

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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'AdminDashboard'])->name('admin.dashboard');
    Route::get('/admin/logout', [AdminController::class, 'AdminLogout'])->name('admin.logout');
    Route::get('/admin/reservation', [AdminController::class, 'AdminReservation'])->name('admin.reservation');


    // Customer Routes
    Route::get('/admin/customer/index', [CustomerController::class, 'index'])->name('admin.customer.index');
    Route::get('/admin/customer/create', [CustomerController::class, 'create'])->name('admin.customer.create');
    Route::post('/admin/customer/index', [CustomerController::class, 'store'])->name('admin.customer.store');
    Route::get('/admin/customer/edit/{id}', [CustomerController::class, 'edit'])->name('admin.customer.edit');
    Route::post('/admin/customer/update/{id}', [CustomerController::class, 'update'])->name('admin.customer.update');
    Route::delete('/admin/customer/delete/{id}', [CustomerController::class, 'destroy'])->name('admin.customer.destroy');
    // End Customer Routes


    // Customer Type Routes
    Route::get('/admin/customertype/index', [CustomerTypeController::class, 'index'])->name('admin.customertype.index');
    Route::get('/admin/customertype/create', [CustomerTypeController::class, 'create'])->name('admin.customertype.create');
    Route::post('/admin/customertype/index', [CustomerTypeController::class, 'store'])->name('admin.customertype.store');
    Route::get('/admin/customertype/edit/{id}', [CustomerTypeController::class, 'edit'])->name('admin.customertype.edit');
    Route::post('/admin/customertype/update/{id}', [CustomerTypeController::class, 'update'])->name('admin.customertype.update');
    Route::delete('/admin/customertype/delete/{id}', [CustomerTypeController::class, 'destroy'])->name('admin.customertype.destroy');
    // End Customer Type Routes


});

Route::middleware(['auth', 'role:user'])->group(function () {
    Route::get('/user/reservation', [UserController::class, 'UserReservation'])->name('user.reservation');
    Route::get('/user/logout', [UserController::class, 'UserLogout'])->name('user.logout');
});

Route::get('/admin/login', [AdminController::class, 'AdminLogin'])->name('admin.login');
Route::get('/user/login', [UserController::class, 'UserLogin'])->name('user.login');
