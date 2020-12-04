<?php

use App\Http\Controllers\ListingsController;
use App\Http\Controllers\ToursController;
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
Auth::routes();
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/tours', [ToursController::class, 'index'])->name('tours.index');
Route::post('/tours', [ToursController::class, 'store'])->name('tours.store');
Route::get('/tours/create', [ToursController::class, 'create'])->name('tours.create');
Route::get('/tours/{tour}', [ToursController::class, 'show'])->name('tours.show');
Route::get('/tours/{tour}/edit', [ToursController::class, 'edit'])->name('tours.edit');
Route::put('/tours/{tour}', [ToursController::class, 'update'])->name('tours.update');
Route::post('/tours/{tour}/publish', [ToursController::class, 'publish'])->name('tours.publish');

Route::get('/listings', [ListingsController::class, 'index'])->name('listings.index');


