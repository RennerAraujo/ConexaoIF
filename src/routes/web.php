<?php

use App\Http\Controllers\DisplayController;
use App\Http\Controllers\NoticiaController;
use App\Http\Controllers\ProgramacaoController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TelaController;
use App\Http\Controllers\UsuarioController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/display/{tela:slug}', [DisplayController::class, 'show'])->name('display.show');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('telas', TelaController::class);
    Route::resource('programacoes', ProgramacaoController::class)->parameters([
        'programacoes' => 'programacao'
    ]);
    Route::resource('noticias', NoticiaController::class);
});

Route::middleware(['auth', 'is.admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::resource('usuarios', UsuarioController::class);
});

require __DIR__ . '/auth.php';