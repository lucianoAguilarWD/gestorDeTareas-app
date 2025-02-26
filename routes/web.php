<?php

use App\Http\Controllers\GestorDeTareasController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\HomeController;

Route::middleware("auth")->group(function () {
    // rutas de perfil
    Route::get('/', [HomeController::class, 'index'])->name('home');

    //rutas CRUD de tareas
    Route::view('/crearTarea', 'createTareas');
    Route::get('editarTarea/{id}', [GestorDeTareasController::class, 'edit'])->name('edit_tarea');
    Route::post('/postCreateTarea', [GestorDeTareasController::class, 'store'])->name('create_tarea');
    Route::delete('/deleteTarea/{id}', [GestorDeTareasController::class, 'destroy'])->name('delete_tarea');
    Route::put('/updateTarea/{id}', [GestorDeTareasController::class, 'update'])->name('update_tarea');
});

// rutas de login
Route::middleware('guest')->group(function () {
    Route::view('/login', 'Auth.login')->name('login');
    Route::view('/registro', 'Auth.register')->name('register');
});
Route::post('/register', [LoginController::class, 'register'])->name('validar_registro');
Route::post('/login', [LoginController::class, 'login'])->name('inicia_sesion');
Route::post('/logout', [LoginController::class, 'logout'])->name('cerrar_sesion');
