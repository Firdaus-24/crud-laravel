<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JenisController;
use App\Http\Controllers\BarangsController;
use App\Http\Controllers\KategorisController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('barangs', [BarangsController::class, 'getAllBarangs']);
Route::post('addBarangs', [BarangsController::class, 'storeBarangs']);
Route::post('updateBarangs', [BarangsController::class, 'updateBarangs']);
Route::post('deleteBarangs', [BarangsController::class, 'deleteBarangs']);

Route::get('kategoris', [KategorisController::class, 'getAllKategoris']);
Route::post('addKategoris', [KategorisController::class, 'storeKategoris']);
Route::post('updateKategoris', [KategorisController::class, 'updateKategoris']);
Route::post('deleteKategoris', [KategorisController::class, 'deleteKategoris']);

Route::get('Jenis', [JenisController::class, 'getAllJenis']);
Route::post('addJenis', [JenisController::class, 'storeJenis']);
Route::post('updateJenis', [JenisController::class, 'updateJenis']);
Route::post('deleteJenis', [JenisController::class, 'deleteJenis']);
