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
use App\Http\Controllers\DiagnosisController;
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
// Route::get('/admin/register', [AdminController::class, 'showRegister'])->name('admin.register');
// Route::post('/admin/register', [AdminController::class, 'register'])->name('admin.register.submit');
Route::get('/admin/dashboard', [AdminController::class, 'showDashboard'])->name('admin.dashboard');
Route::post('/admin/logout', [AdminController::class, 'logout'])->name('admin.logout');

// Patient
Route::get('/admin/patient', [PatientController::class, 'showList'])->name('admin.patient');
Route::get('/admin/patient/add', [PatientController::class, 'createForm'])->name('admin.patient.add');
Route::post('/admin/patient/add', [PatientController::class, 'store'])->name('admin.patient.store');
Route::get('/admin/patient/edit/{id}', [PatientController::class, 'editForm'])->name('admin.patient.edit');
Route::put('/admin/patient/edit/{id}', [PatientController::class, 'update'])->name('admin.patient.update');
Route::delete('/admin/patient/delete/{id}', [PatientController::class, 'destroy'])->name('admin.patient.destroy');
Route::get('/admin/patient/search', [PatientController::class, 'search'])->name('admin.patient.search');


// hospital
Route::get('/admin/hospital', [HospitalController::class, 'showList'])->name('admin.hospital');
Route::get('/admin/hospital/add', [HospitalController::class, 'createForm'])->name('admin.hospital.add');
Route::post('/admin/hospital/add', [HospitalController::class, 'store'])->name('admin.hospital.store');
Route::get('/admin/hospital/edit/{id}', [HospitalController::class, 'editForm'])->name('admin.hospital.edit');
Route::put('/admin/hospital/edit/{id}', [HospitalController::class, 'update'])->name('admin.hospital.update');
Route::delete('/admin/hospital/delete/{id}', [HospitalController::class, 'destroy'])->name('admin.hospital.destroy');

// Roles
Route::get('/admin/role', [RoleController::class, 'showList'])->name('admin.role');
Route::get('/admin/role/add', [RoleController::class, 'createForm'])->name('admin.role.add');
Route::post('/admin/role/add', [RoleController::class, 'store'])->name('admin.role.store');
Route::get('/admin/role/edit/{id}', [RoleController::class, 'editForm'])->name('admin.role.edit');
Route::put('/admin/role/edit/{id}', [RoleController::class, 'update'])->name('admin.role.update');
Route::delete('/admin/role/delete/{id}', [RoleController::class, 'destroy'])->name('admin.role.destroy');

// Diagnosis
Route::get('/admin/diagnosis', [DiagnosisController::class, 'showList'])->name('admin.diagnosis');
Route::get('/admin/diagnosis/add', [DiagnosisController::class, 'createForm'])->name('admin.diagnosis.add');
Route::post('/admin/diagnosis/add', [DiagnosisController::class, 'store'])->name('admin.diagnosis.store');
Route::get('/admin/diagnosis/edit/{id}', [DiagnosisController::class, 'editForm'])->name('admin.diagnosis.edit');
Route::put('/admin/diagnosis/edit/{id}', [DiagnosisController::class, 'update'])->name('admin.diagnosis.update');
Route::delete('/admin/diagnosis/delete/{id}', [DiagnosisController::class, 'destroy'])->name('admin.diagnosis.destroy');

Route::get('/admin/staff', [StaffController::class, 'showList'])->name('admin.staff');
Route::get('/admin/staff/add', [StaffController::class, 'createForm'])->name('admin.staff.add');
Route::post('/admin/staff/add', [StaffController::class, 'store'])->name('admin.staff.store');
Route::get('/admin/staff/edit/{id}', [StaffController::class, 'editForm'])->name('admin.staff.edit');
Route::put('/admin/staff/edit/{id}', [StaffController::class, 'update'])->name('admin.staff.update');
Route::delete('/admin/staff/delete/{id}', [StaffController::class, 'destroy'])->name('admin.staff.destroy');

Route::get('/admin/appointment', [AppointmentController::class, 'showList'])->name('admin.appointment');
Route::get('/admin/appointment/add-patient', [AppointmentController::class, 'createPatientForm'])->name('admin.appointment.add-patient');
Route::get('/admin/appointment/{id}/add', [AppointmentController::class, 'createForm'])->name('admin.appointment.add');
Route::post('/admin/appointment/add-patient', [AppointmentController::class, 'storePatientForm'])->name('admin.appointment.store-patient');
Route::post('/admin/appointment/{id}/add', [AppointmentController::class, 'store'])->name('admin.appointment.store');
Route::delete('/admin/appointment/delete/{id}', [AppointmentController::class, 'destroy'])->name('admin.appointment.destroy');
Route::get('/admin/appointment/edit/{id}', [AppointmentController::class, 'editForm'])->name('admin.appointment.edit');
Route::put('/admin/appointment/edit/{id}', [AppointmentController::class, 'update'])->name('admin.appointment.update');

Route::get('/admin/prescription', [PrescriptionController::class, 'showList'])->name('admin.prescription');
Route::get('/admin/appointment/add/{id}', [PrescriptionController::class, 'createForm'])->name('admin.prescription.add');
Route::post('/admin/prescription/add/{id}', [PrescriptionController::class, 'store'])->name('admin.prescription.store');
Route::get('/admin/prescription/edit/{id}', [PrescriptionController::class, 'editForm'])->name('admin.prescription.edit');
Route::put('/admin/prescription/edit/{id}', [PrescriptionController::class, 'update'])->name('admin.prescription.update');
Route::delete('/admin/prescription/delete/{id}', [PrescriptionController::class, 'destroy'])->name('admin.prescription.destroy');
Route::get('/diagnosis/suggestions', [PrescriptionController::class, 'getDiagnosisSuggestions'])->name('diagnosis.suggestions');

