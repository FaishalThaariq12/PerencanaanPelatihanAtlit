<?php


use Illuminate\Support\Facades\Route;
// VIEW
use App\Http\Controllers\PelatihanAtlitController;
use App\Http\Controllers\DataAtlitController;
// DASHBOARD
use App\Http\Controllers\DashboardTaktikController;
use App\Http\Controllers\DashboardPelatihanController;
use App\Http\Controllers\DashboardAsupanController;
use App\Http\Controllers\DashboardStatistikController;
// Login Admin
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;

// ####################### Bagian Home Route ##########################
Route::get('/', function () {
    return view('home');
});

Route::get('/datapemain', function () {
    return view('datapemains');
});

Route::get('/stat', function () {
    return view('statistik');
});
// ####################### Bagian Pelatihan Route ##########################
Route::get('/pelatihan', [PelatihanAtlitController::class, 'index']);
Route::get('taktiks/{taktik:slug}', [PelatihanAtlitController::class, 'show']);
Route::get('pelatihans/{pelatihan:slug}', [PelatihanAtlitController::class, 'showpelatihan']);
Route::get('asupans/{asupan:slug}', [PelatihanAtlitController::class, 'showasupan']);

// ####################### Bagian Data Atlit Route ##########################
Route::get('/datapemain', [DataAtlitController::class, 'index']);
Route::get('statistik/{statistik:slug}', [DataAtlitController::class, 'show']);

// #############################################################
// ####### BAGIAN ADMIN #####
// <<<<<<<<<< Route Login User >>>>>>>>>
Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'authenticate']);
Route::post('/logout', [LoginController::class, 'logout']);
Route::get('/dashboard', function () {
    return view('dashboard.index');
})->middleware('auth');

// <<<<<<< Dashboard Taktik >>>>>>>>>>>
Route::get('/dashboard/taktiks/checkSlug', [DashboardTaktikController::class, 'checkSlug'])
    ->middleware('auth');
Route::resource('/dashboard/taktiks', DashboardTaktikController::class)->middleware('auth');

// <<<<<<< Dashboard Pelatihan >>>>>>>>>>>
Route::get('/dashboard/pelatihans/checkSlug', [DashboardPelatihanController::class, 'checkSlug'])
    ->middleware('auth');
Route::resource('/dashboard/pelatihans', DashboardPelatihanController::class)->middleware('auth');

// <<<<<<< Dashboard Asupan Gizi >>>>>>>>>>>
Route::get('/dashboard/asupans/checkSlug', [DashboardAsupanController::class, 'checkSlug'])
    ->middleware('auth');
Route::resource('/dashboard/asupans', DashboardAsupanController::class)->middleware('auth');

// <<<<<<< Dashboard Statistik Pemain >>>>>>>>>>>
Route::get('/dashboard/statistiks/checkSlug', [DashboardStatistikController::class, 'checkSlug'])
    ->middleware('auth');
Route::resource('/dashboard/statistiks', DashboardStatistikController::class)->middleware('auth');