<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BandsController;
use App\Http\Controllers\AlbumsController;
use App\Http\Controllers\DashboardController;

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

Route::get('/dashboard', [DashboardController::class, 'viewDashboard']) -> name('dashboard')->middleware('auth');

Route::get('/all-users', [UserController::class, 'getAllUsers']) -> name('users.all')->middleware('admin');
Route::get('/add-users', [UserController::class, 'addUser']) -> name('users.add');
Route::post('/store-user', [UserController::class, 'storeUser']) -> name('user.store');
Route::get('/view-user/{id}', [UserController::class, 'viewUser']) -> name('user.view')->middleware('admin');
Route::post('/update-user/{id}', [UserController::class, 'updateUser']) -> name('user.update')->middleware('auth');
Route::get('/delete-user/{id}', [UserController::class, 'deleteUser']) -> name('user.delete')->middleware('admin');

Route::get('/bands', [BandsController::class, 'getAll']) -> name('bands.all');
Route::get('/add-band', [BandsController::class, 'addBand']) -> name('band.add')->middleware('auth');
Route::post('/store-band', [BandsController::class, 'storeBand']) -> name('band.store')->middleware('admin');
Route::post('/update-band/{id}', [BandsController::class, 'updateBand']) -> name('band.update')->middleware('auth');
Route::get('/delete-band/{id}', [BandsController::class, 'deleteBand']) -> name('band.delete')->middleware('admin');

Route::get('/bands/{id}/albums', [AlbumsController::class, 'getAll']) -> name('albums.view');
Route::get('/albums', [AlbumsController::class, 'getAlbums']) -> name('albums.all');
Route::get('/add-album', [AlbumsController::class, 'addAlbum']) -> name('album.add')->middleware('auth');
Route::post('/store-album', [AlbumsController::class, 'storeAlbum']) -> name('album.store')->middleware('admin');
Route::post('/update-album/{id}', [AlbumsController::class, 'updateAlbum']) -> name('album.update')->middleware('auth');
Route::get('/delete-album/{id}', [AlbumsController::class, 'deleteAlbum']) -> name('album.delete')->middleware('admin');


Route::fallback(function () {
    return view('general.not_found');
});
