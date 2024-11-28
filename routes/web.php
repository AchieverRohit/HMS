<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\PrescriptionController;

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

Route::get('/admin/patient', [PatientController::class, 'showProfile'])->name('admin.patient');
Route::get('/admin/doctor', [DoctorController::class, 'showProfile'])->name('admin.doctor');
Route::get('/admin/prescription', [PrescriptionController::class, 'showProfile'])->name('admin.prescription');

Route::get('/admin/patient/add', [PatientController::class, 'createForm'])->name('admin.patient.add');
// Route::get('/admin/doctor/add', [DoctorController::class, 'createForm'])->name('admin.doctor-add');
// Route::get('/admin/prescription/add', [PrescriptionController::class, 'createForm'])->name('admin.prescription-add');

Route::post('/admin/patient/add', [PatientController::class, 'store'])->name('admin.patient.store');
