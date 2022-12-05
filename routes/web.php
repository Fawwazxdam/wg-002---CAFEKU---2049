<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\UserController;
use App\Models\Menu;
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

// HALAMAN AWAL
Route::get('/', function () {
    $data = Menu::all();
    return view('beranda',compact('data'));
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// HALAMAN YANG HANYA BISA DIAKSES OWNER
Route::middleware(['auth', 'owner'])->group(function () {
    Route::resource('/user', UserController::class);
    Route::get('/delus/{id}', [App\Http\Controllers\UserController::class, 'destroy'])->name('delus');
    
});

// HALAMAN YANG BISA DIAKSES ADMIN DAN OWNER
Route::middleware(['auth'])->group(function () {
    Route::resource('/kategori', KategoriController::class);
    Route::get('/delkat/{kategori}', [App\Http\Controllers\KategoriController::class, 'destroy'])->name('delkat');
    Route::resource('/menu', MenuController::class);
    Route::get('/delme/{menu}', [App\Http\Controllers\MenuController::class, 'destroy'])->name('delme');
    Route::resource('/dashboard', DashboardController::class);
    
});