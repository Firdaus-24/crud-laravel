<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JenisController;
use App\Http\Controllers\BarangsController;
use App\Http\Controllers\KategorisController;

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


Route::get('kategoris', [KategorisController::class, 'index']);
Route::post('kategoris', [KategorisController::class, 'store'])->name('kategorisAdd');
Route::get('kategoris/{id}', [KategorisController::class, 'edit'])->name('kategorisEdit');
Route::post('kategoris/{id}/edit', [KategorisController::class, 'update'])->name('kategorisUpdate');
Route::post('kategoris/{id}', [KategorisController::class, 'destroy'])->name('kategorisDelete');

Route::get('jenis', [JenisController::class, 'index']);
Route::post('jenis', [JenisController::class, 'store'])->name('jenisAdd');
Route::get('jenis/{id}', [JenisController::class, 'edit'])->name('jenisEdit');
Route::post('jenis/{id}/edit', [JenisController::class, 'update'])->name('jenisUpdate');
Route::post('jenis/{id}', [JenisController::class, 'destroy'])->name('jenisDelete');

Route::get('barangs', [BarangsController::class, 'index']);
Route::post('barangs', [BarangsController::class, 'store'])->name('barangsAdd');
Route::get('barangs/{id}', [BarangsController::class, 'edit'])->name('barangsEdit');
Route::post('barangs/{id}/edit', [BarangsController::class, 'update'])->name('barangsUpdate');
Route::post('barangs/{id}', [BarangsController::class, 'destroy'])->name('barangsDelete');
