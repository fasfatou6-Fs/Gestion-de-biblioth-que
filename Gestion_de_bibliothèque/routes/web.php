<?php

use App\Http\Controllers\LivreController;

Route::middleware('auth')->group(function () {
    Route::get('/livres/create', [LivreController::class, 'create'])
        ->middleware('can:create,App\Models\Livre');

    Route::post('/livres', [LivreController::class, 'store'])
        ->middleware('can:create,App\Models\Livre');
});

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
