<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BookingController;
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
})->name('welcome');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');
Route::get('/buses', [BookingController::class, 'index'])->middleware(['auth', 'verified'])->name('buses');
Route::post('/buses', [BookingController::class, 'search_bus'])->middleware(['auth', 'verified'])->name('search_bus');
Route::post('/book-bus', [BookingController::class, 'book_bus'])->middleware(['auth', 'verified'])->name('book_bus');
Route::post('/cancel-booking', [BookingController::class, 'a'])->middleware(['auth', 'verified'])->name('cancel_booking');
Route::get('/manage-booking', [BookingController::class, 'bookings'])->middleware(['auth', 'verified'])->name('manage-booking');
Route::get('/help', function () {
    return view('help');
})->middleware(['auth', 'verified'])->name('help');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
