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

// Auth
Route::get('/login', [App\Http\Controllers\Auth\LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [App\Http\Controllers\Auth\LoginController::class, 'login']);
Route::post('/logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');
Route::get('/register', [App\Http\Controllers\Auth\RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [App\Http\Controllers\Auth\RegisterController::class, 'register']);

Route::middleware('auth')->group(function () {
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    // Routes accessibles par tout utilisateur connecté (lecture + actions utilisateurs)
    Route::resource('livres', LivreController::class)->only(['index', 'show'])->names(['index' => 'livres.index', 'show' => 'livres.show'])->parameters(['livres' => 'livre']);
    Route::resource('emprunts', EmpruntController::class)->only(['index', 'show', 'create', 'store'])->names([
        'index' => 'emprunts.index', 'show' => 'emprunts.show', 'create' => 'emprunts.create', 'store' => 'emprunts.store'
    ])->parameters(['emprunts' => 'emprunt']);
    Route::get('/mes-penalites', [PenaliteController::class, 'mesPenalites'])->name('penalites.mes');

    Route::middleware('role:admin|bibliothecaire')->group(function () {
        Route::get('/logs', [DashboardController::class, 'logs'])->name('logs.index');

        // Livres - actions de gestion
        Route::resource('livres', LivreController::class)->except(['index', 'show']);

        // Emprunts - actions réservées aux gestionnaires
        Route::resource('emprunts', EmpruntController::class)->only(['edit', 'update', 'destroy']);
        Route::post('/emprunts/{emprunt}/marquer-retour', [EmpruntController::class, 'marquerRetour'])->name('emprunts.marquer-retour');
        Route::get('/emprunts-en-retard', [EmpruntController::class, 'enRetard'])->name('emprunts.en_retard');
        Route::get('/emprunts/{emprunt}/penalites', [EmpruntController::class, 'penalites'])->name('emprunts.penalites');

        // Pénalités - gestion complète
        Route::resource('penalites', PenaliteController::class);
        Route::post('/penalites/{penalite}/payer', [PenaliteController::class, 'payer'])->name('penalites.payer');
        Route::get('/penalites-non-payees', [PenaliteController::class, 'nonPayees'])->name('penalites.non_payees');
    });
});
