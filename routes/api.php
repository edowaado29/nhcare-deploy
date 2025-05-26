<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AcaraController;
use App\Http\Controllers\ArtikelController;
use App\Http\Controllers\ProgramController;
use App\Http\Controllers\AnakasuhController;
use App\Http\Controllers\DonasiController;
use App\Http\Controllers\KedonaturanController;


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

Route::post('/daftar', [KedonaturanController::class, 'createDonatur']);
Route::post('/login', [KedonaturanController::class, 'loginDonatur']);
Route::post('/resetpassword', [KedonaturanController::class, 'resetPsswrd']); //di login



Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::get('/get_user', [KedonaturanController::class, 'getDntrFromToken']);
    Route::post('/logout', [KedonaturanController::class,'logout']);
    Route::post('/updateDntr', [KedonaturanController::class,'updateDntr']);
});

Route::post('/verify-email', [KedonaturanController::class, 'verifyEmail']);
Route::post('/verify-answer', [KedonaturanController::class, 'verifyAnswer']);
Route::post('/reset-password', [KedonaturanController::class, 'resetPassword']); //di profil

Route::get('/programs', [ProgramController::class,'programs']);
Route::get('/artikels', [ArtikelController::class, 'artikels']);
Route::get('/latestArtikels', [ArtikelController::class, 'latestArtikels']);
Route::get('/acaras', [AcaraController::class,'acaras']);


Route::get('/anakasuh', [AnakasuhController::class, 'anakasuhs']);

Route::post('/create-transaction', [DonasiController::class, 'createTransaction']);
Route::post('/handle-notification', [DonasiController::class, 'handleNotification']);
Route::get('/alokasi', [DonasiController::class, 'alokasi']);
Route::get('/total-donations', [DonasiController::class, 'getTotalDonations']);
Route::get('/donations/{id_donatur}', [DonasiController::class, 'getDonationHistory']);
