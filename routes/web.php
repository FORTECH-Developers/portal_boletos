<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BoletoController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\AssociadoController;
use App\Http\Controllers\DashboardController;



Route::get('/', function () {
    return view('login');
});

Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login'])->name('login.post');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');


Route::middleware(['auth'])->group(function () {
    Route::get('/boletos', [BoletoController::class, 'index'])->name('boletos.index');
    Route::get('/boletos/download/{id}', [BoletoController::class, 'download'])->name('boletos.download');
});

Route::resource('associados', AssociadoController::class)->middleware('auth');

Route::get('/dashboard', [BoletoController::class, 'index'])->middleware('auth');

Route::get('/sincronizar-associados', [AssociadoController::class, 'sincronizarAssociados']);

Route::get('/associados/fetch', [AssociadoController::class, 'fetchAssociados']);

Route::get('/associados/salvar', [AssociadoController::class, 'listarAssociados']);

Route::get('/boletos', [BoletoController::class, 'index'])->name('boletos.index')->middleware('auth');

Route::get('/boletos/sincronizar', [BoletoController::class, 'sincronizarBoletos'])->name('boletos.sincronizar');
