<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\EstadosController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {
    Route::get('/home', function () {
        return view('home');
    })->name('home');
    ;
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    //RUTAS PARA ESTADOS
    Route::get("/estados/data", [EstadosController::class, 'getData'])->name('estados.data');
});
Route::middleware('guest')->group(function () {
    Route::get("/login", [AuthController::class, 'index'])->name('login-page');
    Route::post("/login", [AuthController::class, 'login'])->name('login');
    Route::post("/register", [AuthController::class, 'register'])->name('register');
});
Route::get('/', function () {
    return redirect('/login');
});