<?php

use App\Http\Controllers\CustomerController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminFilteredSearchController;
use App\Http\Controllers\AdminReportsController;
use App\Http\Controllers\AdminSearchController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ReservationController;
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
    return view('welcome2');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/rooms', [ReservationController::class, 'datePicker']);


// Route::get('/rooms',[HomeController::class,'show']);

Route::post('/rooms/{pickupDate}/{dropoffDate}/{location}/{numOfDays}',[ReservationController::class,'filter']);

Route::post('/reserve/{id}/{pickupDate}/{dropoffDate}/{location}/{numOfDays}',[ReservationController::class,'reserve']);
Route::get('/reservations',[CustomerController::class,'index'])->middleware('auth');
Route::post('/reservations/pay/{res_id}',[CustomerController::class,'pay']);


Route::get('completeProfile',[CustomerController::class,'create'])->middleware('auth');
Route::post('completeProfile',[CustomerController::class,'store'])->middleware('auth');


Route::post('delete/{res_id}',[ReservationController::class,'delete']);



//Admin
// Dashboard
Route::get("dashboard",[AdminController::class,'viewDashboard']);
//Rooms
Route::get("/admin/rooms",[AdminController::class,'indexRooms']);
Route::get("/admin/rooms/edit/{room_id}",[AdminController::class,'editRoom']);
Route::post("/admin/rooms/edit/{room_id}",[AdminController::class,'updateRoom']);
Route::post("/admin/rooms/delete/{room_id}",[AdminController::class,'deleteRoom']);
Route::post("/admin/rooms/status/available/{room_id}",[AdminController::class,'makeAvailable']);
Route::post("/admin/rooms/status/unAvailable/{room_id}",[AdminController::class,'makeUnavailable']);
Route::get("/admin/rooms/add",[AdminController::class,'createRoom']);
Route::post("/admin/rooms/add",[AdminController::class,'storeRoom']);
//Reservations
Route::get("/admin/reservations",[AdminController::class,'indexReservations']);
//Search
//By Room reservations
Route::get("/admin/search/rooms",[AdminSearchController::class,'searchRooms']);
Route::get("/admin/search/rooms/{room_id}",[AdminSearchController::class,'showFilteredRooms']);
//By Customer reservations
Route::get("/admin/search/customers",[AdminSearchController::class,'searchCustomers']);
Route::get("/admin/search/customers/{user_id}",[AdminSearchController::class,'showFilteredCustomer']);
//By reservation date
Route::get("/admin/search/reservations",[AdminSearchController::class,'searchReservations']);
Route::get("/admin/search/reservations/pickupDate",[AdminSearchController::class,'showFilteredReservations']);
//Availability
Route::get("/admin/search/availability",[AdminSearchController::class,'searchAvailable']);
Route::get("/admin/search/availability/pickupDate",[AdminSearchController::class,'showFilteredAvailable']);




















// Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
