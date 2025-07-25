<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TelaController;
use App\Http\Controllers\ProfileController; // 1. Importe o ProfileController

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('telas', TelaController::class);
});

require __DIR__ . '/auth.php';