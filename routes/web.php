<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Public\HomeController;
use App\Http\Controllers\Public\DoctorController;
use App\Http\Controllers\Public\PAController;
use App\Http\Controllers\Public\StaffController;
use App\Http\Controllers\Public\ServiceController;
use App\Http\Controllers\Public\RoomController;
use App\Http\Controllers\Public\AboutController;
use App\Http\Controllers\Public\AppointmentController;
use App\Http\Controllers\Dashboard\AdminController;
use App\Http\Controllers\Dashboard\DoctorDashboardController;
use App\Http\Controllers\Dashboard\PADashboardController;
use App\Http\Controllers\Dashboard\PatientDashboardController;
use App\Http\Controllers\Dashboard\LabController;
use App\Http\Controllers\Dashboard\ReceptionistController;
use App\Http\Controllers\Dashboard\ManagerController;
use App\Http\Controllers\ProfileController;

// Public Routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/doctors', [DoctorController::class, 'index'])->name('doctors.index');
Route::get('/pas', [PAController::class, 'index'])->name('pas.index');
Route::get('/staff', [StaffController::class, 'index'])->name('staff.index');
Route::get('/services', [ServiceController::class, 'index'])->name('services.index');
Route::get('/rooms', [RoomController::class, 'index'])->name('rooms.index');
Route::get('/about', [AboutController::class, 'index'])->name('about');
Route::get('/appointment', [AppointmentController::class, 'create'])->name('appointment.create');
Route::post('/appointment', [AppointmentController::class, 'store'])->name('appointment.store');
Route::get('/get-pa/{doctorId}', [AppointmentController::class, 'getPA'])->name('get.pa');

// Authentication Routes (Laravel Breeze)
require __DIR__.'/auth.php';

// Authenticated Routes
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        $user = auth()->user();
        
        // Redirect based on role
        switch($user->role) {
            case 'admin':
                return redirect()->route('admin.dashboard');
            case 'manager':
                return redirect()->route('manager.dashboard');
            case 'doctor':
                return redirect()->route('doctor.dashboard');
            case 'pa':
                return redirect()->route('pa.dashboard');
            case 'receptionist':
                return redirect()->route('receptionist.dashboard');
            case 'lab_tester':
                return redirect()->route('lab.dashboard');
            case 'patient':
                return redirect()->route('patient.dashboard');
            default:
                return redirect('/');
        }
    })->name('dashboard');
    
    // Profile Routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Admin Dashboard Routes
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');
    
    // Doctors Management
    Route::get('/doctors', [AdminController::class, 'doctors'])->name('doctors');
    Route::post('/doctors', [AdminController::class, 'storeDoctor'])->name('doctors.store');
    Route::put('/doctors/{id}', [AdminController::class, 'updateDoctor'])->name('doctors.update');
    Route::delete('/doctors/{id}', [AdminController::class, 'deleteDoctor'])->name('doctors.delete');
    
    // PAs Management
    Route::get('/pas', [AdminController::class, 'pas'])->name('pas');
    Route::post('/pas', [AdminController::class, 'storePA'])->name('pas.store');
    Route::put('/pas/{id}', [AdminController::class, 'updatePA'])->name('pas.update');
    Route::delete('/pas/{id}', [AdminController::class, 'deletePA'])->name('pas.delete');
    
    // Staff Management - FIXED ROUTES
    Route::get('/staff', [AdminController::class, 'staff'])->name('staff');
    Route::post('/staff', [AdminController::class, 'storeStaff'])->name('staff.store');
    Route::put('/staff/{id}', [AdminController::class, 'updateStaff'])->name('staff.update');
    Route::delete('/staff/{id}', [AdminController::class, 'deleteStaff'])->name('staff.delete');


    // Patients Management
    Route::get('/patients', [AdminController::class, 'patients'])->name('patients');
    Route::post('/patients', [AdminController::class, 'storePatient'])->name('patients.store');
    Route::put('/patients/{id}', [AdminController::class, 'updatePatient'])->name('patients.update');
    Route::delete('/patients/{id}', [AdminController::class, 'deletePatient'])->name('patients.delete');
    //Route::put('/admin/patients/{id}', [AdminController::class, 'updatePatient'])->name('patients.update');
    
    // Services Management
    Route::get('/services', [AdminController::class, 'services'])->name('services');
    Route::post('/services', [AdminController::class, 'storeService'])->name('services.store');
    Route::put('/services/{id}', [AdminController::class, 'updateService'])->name('services.update');
    Route::delete('/services/{id}', [AdminController::class, 'deleteService'])->name('services.delete');
    
    // Rooms Management
    Route::get('/rooms', [AdminController::class, 'rooms'])->name('rooms');
    Route::post('/rooms', [AdminController::class, 'storeRoom'])->name('rooms.store');
    Route::put('/rooms/{id}', [AdminController::class, 'updateRoom'])->name('rooms.update');
    Route::delete('/rooms/{id}', [AdminController::class, 'deleteRoom'])->name('rooms.delete');
});

// Manager Dashboard Routes
Route::middleware(['auth', 'role:manager'])->prefix('manager')->name('manager.')->group(function () {
    Route::get('/dashboard', [ManagerController::class, 'index'])->name('dashboard');
    Route::get('/staff', [ManagerController::class, 'staff'])->name('staff');
    Route::put('/staff/{id}', [ManagerController::class, 'updateStaff'])->name('staff.update');
    Route::get('/rooms', [ManagerController::class, 'rooms'])->name('rooms');
    Route::put('/rooms/{id}', [ManagerController::class, 'updateRoom'])->name('rooms.update');
});

// Doctor Dashboard Routes
Route::middleware(['auth', 'role:doctor'])->prefix('doctor')->name('doctor.')->group(function () {
    Route::get('/dashboard', [DoctorDashboardController::class, 'index'])->name('dashboard');
    Route::get('/patients', [DoctorDashboardController::class, 'patients'])->name('patients');
    Route::get('/appointments', [DoctorDashboardController::class, 'appointments'])->name('appointments');
    Route::patch('/appointments/{id}/status', [DoctorDashboardController::class, 'updateAppointmentStatus'])->name('appointments.status');
    Route::post('/reports', [DoctorDashboardController::class, 'storeReport'])->name('reports.store');
});

// PA Dashboard Routes
Route::middleware(['auth', 'role:pa'])->prefix('pa')->name('pa.')->group(function () {
    Route::get('/dashboard', [PADashboardController::class, 'index'])->name('dashboard');
    Route::get('/appointments', [PADashboardController::class, 'appointments'])->name('appointments');
   Route::patch('/pa/appointments/{id}/status', [PADashboardController::class, 'updateAppointmentStatus'])->name('pa.appointments.status');
   Route::patch('/appointments/{id}/status', [PADashboardController::class, 'updateAppointmentStatus'])->name('appointments.status');
});

// Receptionist Dashboard Routes
Route::middleware(['auth', 'role:receptionist'])->prefix('receptionist')->name('receptionist.')->group(function () {
    Route::get('/dashboard', [ReceptionistController::class, 'index'])->name('dashboard');
    Route::post('/appointments', [ReceptionistController::class, 'storeAppointment'])->name('appointments.store');
    Route::get('/appointments', [ReceptionistController::class, 'appointments'])->name('appointments');
    Route::delete('/appointments/{id}', [ReceptionistController::class, 'cancelAppointment'])->name('appointments.cancel');
   
    // Patients Management
    Route::get('/patients', [ReceptionistController::class, 'patients'])->name('patients');
    Route::post('/patients', [ReceptionistController::class, 'storePatient'])->name('patients.store');
    Route::put('/patients/{id}', [ReceptionistController::class, 'updatePatient'])->name('patients.update');
    Route::delete('/patients/{id}', [ReceptionistController::class, 'deletePatient'])->name('patients.delete');
    Route::put('/admin/patients/{id}', [ReceptionistController::class, 'updatePatient'])->name('admin.patients.update');
    Route::get('/patients', [App\Http\Controllers\Dashboard\ReceptionistController::class, 'patients'])->name('patients');
});

// Lab Tester Dashboard Routes
Route::middleware(['auth', 'role:lab_tester'])->prefix('lab')->name('lab.')->group(function () {
    Route::get('/dashboard', [LabController::class, 'index'])->name('dashboard');
    Route::post('/tests', [LabController::class, 'storeTest'])->name('tests.store');
    Route::get('/tests', [LabController::class, 'tests'])->name('tests');
    Route::put('/tests/{id}', [LabController::class, 'updateTest'])->name('tests.update');
    Route::get('/tests/{id}', [LabController::class, 'showTest'])->name('tests.show');
    Route::get('/lab/tests/{id}/pdf', [App\Http\Controllers\Dashboard\LabController::class, 'generatePDF'])->name('lab.tests.pdf')->middleware(['auth', 'role:lab_tester']);
    Route::delete('/tests/{id}', [LabController::class, 'deleteTest'])->name('tests.delete');
});

// Patient Dashboard Routes
Route::middleware(['auth', 'role:patient'])->prefix('patient')->name('patient.')->group(function () {
    Route::get('/dashboard', [PatientDashboardController::class, 'index'])->name('dashboard');
    Route::put('/profile', [PatientDashboardController::class, 'updateProfile'])->name('profile.update');
    Route::get('/appointments', [PatientDashboardController::class, 'appointments'])->name('appointments');
    Route::get('/reports', [PatientDashboardController::class, 'reports'])->name('reports');
    Route::get('/reports/{id}/download', [PatientDashboardController::class, 'downloadReport'])->name('reports.download');
});

// About page routes
Route::get('/about', [App\Http\Controllers\Public\AboutController::class, 'index'])->name('about');
Route::post('/about/contact', [App\Http\Controllers\Public\AboutController::class, 'sendContact'])->name('about.contact');
