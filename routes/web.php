<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\RoomTypeController;
use App\Http\Controllers\ReservationController;
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


    // Customer Routes
    Route::get('/admin/customer/index', [CustomerController::class, 'index'])->name('admin.customer.index');
    Route::get('/admin/customer/create', [CustomerController::class, 'create'])->name('admin.customer.create');
    Route::post('/admin/customer/index', [CustomerController::class, 'store'])->name('admin.customer.store');
    Route::get('/admin/customer/edit/{id}', [CustomerController::class, 'edit'])->name('admin.customer.edit');
    Route::post('/admin/customer/update/{id}', [CustomerController::class, 'update'])->name('admin.customer.update');
    Route::delete('/admin/customer/delete/{id}', [CustomerController::class, 'destroy'])->name('admin.customer.destroy');
    // End Customer Routes


    // Customer Type Routes
    Route::get('/admin/customertype', [CustomerTypeController::class, 'index'])->name('admin.customertype.index');
    Route::get('/admin/customertype/create', [CustomerTypeController::class, 'create'])->name('admin.customertype.create');
    Route::post('/admin/customertype', [CustomerTypeController::class, 'store'])->name('admin.customertype.store');
    Route::get('/admin/customertype/edit/{id}', [CustomerTypeController::class, 'edit'])->name('admin.customertype.edit');
    Route::post('/admin/customertype/update/{id}', [CustomerTypeController::class, 'update'])->name('admin.customertype.update');
    Route::delete('/admin/customertype/delete/{id}', [CustomerTypeController::class, 'destroy'])->name('admin.customertype.destroy');
    // End Customer Type Routes


    // Room Routes
    Route::get('/admin/room/table', [RoomController::class, 'index'])->name('admin.room.index');
    Route::get('/admin/room/create', [RoomController::class, 'create'])->name('admin.room.create');
    Route::post('/admin/room/index', [RoomController::class, 'store'])->name('admin.room.store');
    Route::get('/admin/room/edit/{id}', [RoomController::class, 'edit'])->name('admin.room.edit');
    Route::post('/admin/room/update/{id}', [RoomController::class, 'update'])->name('admin.room.update');
    Route::delete('/admin/room/delete/{id}', [RoomController::class, 'destroy'])->name('admin.room.destroy');
    // End Room Routes


    // Room Type Routes
    Route::get('/admin/roomtype', [RoomTypeController::class, 'index'])->name('admin.roomtype.index');
    Route::get('/admin/roomtype/create', [RoomTypeController::class, 'create'])->name('admin.roomtype.create');
    Route::post('/admin/roomtype', [RoomTypeController::class, 'store'])->name('admin.roomtype.store');
    Route::get('/admin/roomtype/edit/{id}', [RoomTypeController::class, 'edit'])->name('admin.roomtype.edit');
    Route::post('/admin/roomtype/update/{id}', [RoomTypeController::class, 'update'])->name('admin.roomtype.update');
    Route::delete('/admin/roomtype/delete/{id}', [RoomTypeController::class, 'destroy'])->name('admin.roomtype.destroy');
    // End Room Type Routes



});

Route::middleware(['auth', 'role:user'])->group(function () {
    Route::get('/user/reservation', [UserController::class, 'UserReservation'])->name('user.reservation');
    Route::get('/user/logout', [UserController::class, 'UserLogout'])->name('user.logout');
});

Route::get('/admin/login', [AdminController::class, 'AdminLogin'])->name('admin.login');
Route::get('/user/login', [UserController::class, 'UserLogin'])->name('user.login');

// Reservation Routes
Route::get('reservation/list', [ReservationController::class, 'list'])->name('reservation.list');
Route::resource('reservation', ReservationController::class);
// End Reservation Routes
