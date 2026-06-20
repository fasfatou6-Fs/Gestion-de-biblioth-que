<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LivreController;
use App\Http\Controllers\EmpruntController;
use App\Http\Controllers\PenaliteController;
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

Route::get('/', function () {
    return view('welcome');
});

// Dashboard
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::get('/logs', [DashboardController::class, 'logs'])->name('logs.index');

// Livres
Route::resource('livres', LivreController::class);

// Emprunts
Route::resource('emprunts', EmpruntController::class);
Route::post('/emprunts/{emprunt}/marquer-retour', [EmpruntController::class, 'marquerRetour'])->name('emprunts.marquer-retour');
Route::get('/emprunts-en-retard', [EmpruntController::class, 'enRetard'])->name('emprunts.en_retard');
Route::get('/emprunts/{emprunt}/penalites', [EmpruntController::class, 'penalites'])->name('emprunts.penalites');

// Pénalités
Route::resource('penalites', PenaliteController::class);
Route::post('/penalites/{penalite}/payer', [PenaliteController::class, 'payer'])->name('penalites.payer');
Route::get('/penalites-non-payees', [PenaliteController::class, 'nonPayees'])->name('penalites.non_payees');
