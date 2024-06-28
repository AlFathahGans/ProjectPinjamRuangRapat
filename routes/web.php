<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MasyarakatController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\BookingController;

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

Auth::routes();

// MIDTRANS
Route::get('/', [HomeController::class, 'index'])->name("home");

// Room

// Menampilkan semua data rooms
Route::get('/rooms', [RoomController::class,'index'])->name('rooms.index');

// Menampilkan form untuk menambah data rooms
Route::get('/rooms/create', [RoomController::class,'create'])->name('rooms.create');

// Menyimpan data rooms yang baru
Route::post('/rooms', [RoomController::class,'store'])->name('rooms.store');

// Menampilkan data rooms berdasarkan ID untuk diedit
Route::get('/rooms/{id}/edit', [RoomController::class,'edit'])->name('rooms.edit');

// Mengupdate data rooms berdasarkan ID
Route::put('/rooms/{id}', [RoomController::class,'update'])->name('rooms.update');

// Menghapus data rooms berdasarkan ID
Route::delete('/rooms/{id}', [RoomController::class,'destroy'])->name('rooms.destroy');

// Menampilkan semua data bookings
Route::get('/bookings', [BookingController::class,'index'])->name('bookings.index');

// Menampilkan form untuk menambah data bookings
Route::get('/bookings/create', [BookingController::class,'create'])->name('bookings.create');

// Menyimpan data bookings yang baru
Route::post('/bookings', [BookingController::class,'store'])->name('bookings.store');

// Menampilkan data bookings berdasarkan ID untuk diedit
Route::get('/bookings/{id}/edit', [BookingController::class,'edit'])->name('bookings.edit');

// Mengupdate data bookings berdasarkan ID
Route::put('/bookings/{id}', [BookingController::class,'update'])->name('bookings.update');

// Menghapus data bookings berdasarkan ID
Route::delete('/bookings/{id}', [BookingController::class,'destroy'])->name('bookings.destroy');