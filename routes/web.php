<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\AssistanceController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\AsistenciaController;

Route::get('/', function () {
    return Inertia::render('Welcome');
})->name('home');

Route::get('dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth', 'verified'])->group(function (){
    Route::get('/employees', [EmployeeController::class, 'index'])->name('employees.index');
    Route::get('/employees/create', [EmployeeController::class, 'create'])->name('employees.create');
    Route::post('/employees', [EmployeeController::class, 'store'])->name('employees.store');
    Route::get('/employees/{employee}', [EmployeeController::class, 'show'])->name('employees.show');
    Route::get('/employees/{employee}/edit', [EmployeeController::class, 'edit'])->name('employees.edit');
    Route::put('/employees/{employee}', [EmployeeController::class, 'update'])->name('employees.update');
    Route::delete('/employees/{employee}', [EmployeeController::class, 'destroy'])->name('employees.destroy');
});
Route::middleware(['auth'])->group(function () {
    Route::inertia('/asistencia', 'Asistencia/Index')->name('asistencia');
});


Route::get('/assistances', [AssistanceController::class, 'index'])->name('assistances.index');
Route::post('/assistances/check-in', [AssistanceController::class, 'checkIn'])->name('assistances.check-in');
Route::post('/assistances/check-out', [AssistanceController::class, 'checkOut'])->name('assistances.check-out');

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
