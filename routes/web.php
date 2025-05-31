<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AlumnoController;
use App\Http\Controllers\PlanController;
use App\Http\Controllers\AsistenciaController;
use App\Http\Controllers\ReunionController;
use App\Http\Controllers\ExamenController;
use App\Http\Controllers\DashboardController;

Route::get('/', fn() => redirect()->route('alumnos.index'));

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

Route::resource('alumnos', AlumnoController::class);
Route::resource('planes', PlanController::class);
Route::resource('reuniones', ReunionController::class);
Route::resource('examenes', ExamenController::class);

// ✅ Agrega explícitamente el index para no perderlo
Route::get('/asistencias', [AsistenciaController::class, 'index'])->name('asistencias.index');
Route::post('/asistencias', [AsistenciaController::class, 'store'])->name('asistencias.store');

// ✅ Agrupa las rutas personalizadas
Route::prefix('asistencias')->group(function () {
    Route::get('/diaria', [AsistenciaController::class, 'formDiaria'])->name('asistencias.diaria');
    Route::get('/manual', [AsistenciaController::class, 'formManual'])->name('asistencias.manual');
    Route::get('/inasistencia', [AsistenciaController::class, 'formInasistencia'])->name('asistencias.inasistencia');
});

