<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{AdminController, AppointmentController, HospitalAuthController, HospitalController, PatientAuthController, PatientController, ReportController, VaccineController};

// Landing Page
Route::get('/', function () {
    return view('home');
});

Route::get('/about', [PatientController::class, 'about']);
// Route::get('/departments', [WebController::class, 'departments']);
// Route::get('/services', [WebController::class, 'services']);
// Route::get('/doctors', [WebController::class, 'doctors']);
// Route::get('/contact', [WebController::class, 'contact']);
// Route::get('/appointment', [WebController::class, 'appointment']);
// Route::get('/faq', [WebController::class, 'faq']);
// Route::get('/privacy', [WebController::class, 'privacy']);
// Route::get('/services_details', [WebController::class, 'services_details']);
// Route::get('/department_details', [WebController::class, 'department_details']);
// Route::get('/terms', [WebController::class, 'terms']);
// Route::get('/testimonials', [WebController::class, 'testimonials']);

// ==================== ADMIN ROUTES ====================
Route::get('/admin/login', [AdminController::class, 'showLogin'])->name('admin.login');
Route::post('/admin/login', [AdminController::class, 'login']);
Route::get('/admin/logout', [AdminController::class, 'logout'])->name('admin.logout');

Route::group(['prefix' => 'admin', 'middleware' => 'admin'], function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/hospitals', [AdminController::class, 'hospitals'])->name('admin.hospitals');
    Route::post('/hospitals/{id}/approve', [AdminController::class, 'approveHospital'])->name('admin.approve.hospital');
    Route::post('/hospitals/{id}/reject', [AdminController::class, 'rejectHospital'])->name('admin.reject.hospital');
    Route::get('/patients', [AdminController::class, 'patients'])->name('admin.patients');
    Route::get('/vaccines', [VaccineController::class, 'index'])->name('admin.vaccines');
    Route::post('/vaccines', [VaccineController::class, 'store'])->name('admin.vaccines.store');
    Route::post('/vaccines/{id}/toggle', [VaccineController::class, 'toggle'])->name('admin.vaccines.toggle');
    Route::get('/bookings', [AdminController::class, 'bookings'])->name('admin.bookings');
    Route::post('/bookings/{id}/approve', [AdminController::class, 'approveBooking'])->name('admin.approve.booking');
    Route::post('/bookings/{id}/reject', [AdminController::class, 'rejectBooking'])->name('admin.reject.booking');
    Route::get('/reports', [ReportController::class, 'index'])->name('admin.reports');
    Route::get('/reports/export/{type}', [ReportController::class, 'export'])->name('admin.reports.export');
});

// ==================== HOSPITAL ROUTES ====================
Route::get('/hospital/register', [HospitalAuthController::class, 'showRegister'])->name('hospital.register');
Route::post('/hospital/register', [HospitalAuthController::class, 'register']);
Route::get('/hospital/login', [HospitalAuthController::class, 'showLogin'])->name('hospital.login');
Route::post('/hospital/login', [HospitalAuthController::class, 'login']);
Route::get('/hospital/logout', [HospitalAuthController::class, 'logout'])->name('hospital.logout');

Route::group(['prefix' => 'hospital', 'middleware' => 'hospital'], function () {
    Route::get('/dashboard', [HospitalController::class, 'dashboard'])->name('hospital.dashboard');
    Route::get('/requests', [HospitalController::class, 'requests'])->name('hospital.requests');
    Route::post('/requests/{id}/approve', [HospitalController::class, 'approveRequest'])->name('hospital.approve.request');
    Route::post('/requests/{id}/reject', [HospitalController::class, 'rejectRequest'])->name('hospital.reject.request');
    Route::get('/test-result/{id}', [HospitalController::class, 'showTestResult'])->name('hospital.test.result');
    Route::post('/test-result/{id}', [HospitalController::class, 'updateTestResult'])->name('hospital.test.result.update');
    Route::get('/vaccination/{id}', [HospitalController::class, 'showVaccination'])->name('hospital.vaccination');
    Route::post('/vaccination/{id}', [HospitalController::class, 'updateVaccination'])->name('hospital.vaccination.update');
});

// ==================== PATIENT ROUTES ====================
Route::get('/patient/register', [PatientAuthController::class, 'showRegister'])->name('patient.register');
Route::post('/patient/register', [PatientAuthController::class, 'register']);
Route::get('/patient/login', [PatientAuthController::class, 'showLogin'])->name('patient.login');
Route::post('/patient/login', [PatientAuthController::class, 'login']);
Route::get('/patient/logout', [PatientAuthController::class, 'logout'])->name('patient.logout');


Route::group(['prefix' => 'patient', 'middleware' => 'patient'], function () {
    Route::get('/dashboard', [PatientController::class, 'dashboard'])->name('patient.dashboard');
    Route::get('/search', [PatientController::class, 'search'])->name('patient.search');
    Route::get('/book/{hospital_id}', [AppointmentController::class, 'showBookForm'])->name('patient.book.form');
    Route::post('/book/{hospital_id}', [AppointmentController::class, 'store'])->name('patient.book.store');
    Route::get('/appointments', [PatientController::class, 'appointments'])->name('patient.appointments');
    Route::get('/results', [PatientController::class, 'results'])->name('patient.results');
    Route::get('/profile', [PatientController::class, 'profile'])->name('patient.profile');
    Route::post('/profile', [PatientController::class, 'updateProfile'])->name('patient.profile.update');
    // Route::get('/patient/profile', [PatientController::class, 'profile'])->name('patient.profile');
    
});


