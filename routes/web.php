<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Dentist\DashboardController as DentistDashboardController;
use App\Http\Controllers\Employee\DashboardController as EmployeeDashboardController;
use App\Http\Controllers\Patient\PatientController;
use App\Http\Controllers\Dentist\DentistController;
use App\Http\Controllers\Appointment\AppointmentController;
use App\Http\Controllers\TreatmentRecord\TreatmentRecordController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Admin Routes
Route::middleware(['auth', 'verified', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
    Route::resource('patients', PatientController::class);
    Route::resource('dentists', DentistController::class);
    Route::resource('appointments', AppointmentController::class);
    Route::resource('treatment-records', TreatmentRecordController::class);
});

// Dentist Routes
Route::middleware(['auth', 'verified', 'role:dentist'])->prefix('dentist')->name('dentist.')->group(function () {
    Route::get('/dashboard', [DentistDashboardController::class, 'index'])->name('dashboard');
    Route::resource('patients', PatientController::class)->only(['index', 'show']);
    Route::resource('appointments', AppointmentController::class);
    Route::resource('treatment-records', TreatmentRecordController::class);
    Route::resource('dentists', DentistController::class)->only(['show']);
});

// Employee Routes
Route::middleware(['auth', 'verified', 'role:employee'])->prefix('employee')->name('employee.')->group(function () {
    Route::get('/dashboard', [EmployeeDashboardController::class, 'index'])->name('dashboard');
    Route::resource('patients', PatientController::class)->only(['index', 'create', 'store', 'show', 'edit', 'update', 'destroy']);
    Route::resource('appointments', AppointmentController::class)->only(['index', 'create', 'store', 'show', 'edit', 'update', 'destroy']);
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
