<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\EstudianteController;

Route::get('/estudiantes', [EstudianteController::class, 'index'])->name('estudiantes.index');

Route::get('/estudiantes/{id}', [EstudianteController::class, 'show'])->name('estudiantes.show');

Route::post('/estudiantes', [EstudianteController::class, 'store'])->name('estudiantes.store');

Route::put('/estudiantes/{id}', [EstudianteController::class, 'update'])->name('estudiantes.update');

Route::delete('/estudiantes/{id}', [EstudianteController::class, 'destroy'])->name('estudiantes.destroy');