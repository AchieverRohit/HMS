<?php

use App\Models\Appointment;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\PrescriptionController;
use App\Http\Controllers\HospitalController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\StaffController;


Route::get('/', function () {
    return view('welcome');
});


// Route::get('/okay', function () {
//     return view('user/index');
// });

// laravel11 build stunning admin panel from scratch step by step guid

Route::get('/admin/login', [AdminController::class, 'showLogin'])->name('admin.login');
Route::post('/admin/login', [AdminController::class, 'login'])->name('admin.login.submit');
Route::get('/admin/profile', [AdminController::class, 'showProfile'])->name('admin.profile');
Route::post('/admin/profile', [AdminController::class, 'updateProfile'])->name('admin.profile.update');
Route::get('/admin/user', [AdminController::class, 'showUserList'])->name('admin.user');
Route::post('/users', [AdminController::class, 'store'])->name('users.store');
Route::put('/users/{id}', [AdminController::class, 'update'])->name('users.update');
Route::delete('/users/{id}', [AdminController::class, 'destroy'])->name('users.destroy');
Route::get('/admin/register', [AdminController::class, 'showRegister'])->name('admin.register');
Route::post('/admin/register', [AdminController::class, 'register'])->name('admin.register.submit');
Route::get('/admin/dashboard', [AdminController::class, 'showDashboard'])->name('admin.dashboard');
Route::post('/admin/logout', [AdminController::class, 'logout'])->name('admin.logout');

// Doctor
Route::get('/admin/doctor', [DoctorController::class, 'showProfile'])->name('admin.doctor');
// Route::get('/admin/patient', [PatientController::class, 'showProfile'])->name('admin.patient');
// Route::post('/admin/patient/add', [PatientController::class, 'store'])->name('admin.patient.store');
// Route::get('/admin/patient/edit/{id}', [PatientController::class, 'editForm'])->name('admin.patient.edit');
// Route::put('/admin/patient/edit/{id}', [PatientController::class, 'update'])->name('admin.patient.update');
// Route::delete('/admin/patient/delete/{id}', [PatientController::class, 'destroy'])->name('admin.patient.destroy');

// Prescription
Route::get('/admin/prescription', [PrescriptionController::class, 'showProfile'])->name('admin.prescription');
// Route::get('/admin/patient', [PatientController::class, 'showProfile'])->name('admin.patient');
// Route::post('/admin/patient/add', [PatientController::class, 'store'])->name('admin.patient.store');
// Route::get('/admin/patient/edit/{id}', [PatientController::class, 'editForm'])->name('admin.patient.edit');
// Route::put('/admin/patient/edit/{id}', [PatientController::class, 'update'])->name('admin.patient.update');
// Route::delete('/admin/patient/delete/{id}', [PatientController::class, 'destroy'])->name('admin.patient.destroy');

// Patient
Route::get('/admin/patient/add', [PatientController::class, 'createForm'])->name('admin.patient.add');
Route::get('/admin/patient', [PatientController::class, 'showList'])->name('admin.patient');
Route::post('/admin/patient/add', [PatientController::class, 'store'])->name('admin.patient.store');
Route::get('/admin/patient/edit/{id}', [PatientController::class, 'editForm'])->name('admin.patient.edit');
Route::put('/admin/patient/edit/{id}', [PatientController::class, 'update'])->name('admin.patient.update');
Route::delete('/admin/patient/delete/{id}', [PatientController::class, 'destroy'])->name('admin.patient.destroy');

Route::get('/admin/appointment/add', [AppointmentController::class, 'createForm'])->name('admin.appointment.add');
Route::get('/admin/appointment', [AppointmentController::class, 'showList'])->name('admin.appointment');
Route::post('/admin/appointment/add', [AppointmentController::class, 'store'])->name('admin.appointment.store');
Route::get('/admin/appointment/edit/{id}', [AppointmentController::class, 'editForm'])->name('admin.appointment.edit');
Route::put('/admin/appointment/edit/{id}', [AppointmentController::class, 'update'])->name('admin.appointment.update');
Route::delete('/admin/appointment/delete/{id}', [AppointmentController::class, 'destroy'])->name('admin.appointment.destroy');


Route::get('/admin/hospital', [HospitalController::class, 'showProfile'])->name('admin.hospital');
Route::get('/admin/role', [RoleController::class, 'showProfile'])->name('admin.roles');
Route::get('/admin/staff', [StaffController::class, 'showProfile'])->name('admin.staff');
