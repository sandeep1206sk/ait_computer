<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\StudentCertificateController;
use App\Http\Controllers\StudentController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// ✅ Public Routes (Accessible WITHOUT Login)
Route::middleware('guest')->group(function () {
    Route::get('/', [AuthController::class, 'login'])->name('/');
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/loginSave', [AuthController::class, 'loginSave'])->name('loginSave');

    Route::get('/register', [AuthController::class, 'register'])->name('register');
    Route::post('/registerSave', [AuthController::class, 'registerSave'])->name('registerSave');

    Route::get('/forgot_password', [AuthController::class, 'forgotPassword'])->name('forgot_password');
    Route::post('/forgot_password', [AuthController::class, 'sendResetLinkEmail']);
});

// 🔐 Protected Routes (Accessible ONLY AFTER Login)
Route::middleware('auth')->group(function () {

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Student Registration & Management
    Route::get('/stuReg', [StudentController::class, 'create'])->name('stuReg');
    Route::post('/storeStudent', [StudentController::class, 'store'])->name('storeStudent');

    Route::get('/students', [StudentController::class, 'index'])->name('students.index');
    Route::get('/students/{id}', [StudentController::class, 'show'])->name('students.show');
    Route::get('/students/{id}/edit', [StudentController::class, 'edit'])->name('students.edit');
    Route::put('/students/{id}/update', [StudentController::class, 'update'])->name('students.update');
    Route::delete('/students/{id}', [StudentController::class, 'destroy'])->name('students.destroy');

    // Student Certificate Routes
    Route::get('/student/{id}', [StudentCertificateController::class, 'getStudent'])->name('student.details');
    Route::get('/certificates/upload', [StudentCertificateController::class, 'create'])->name('certificates.create');
    Route::post('/certificates/upload', [StudentCertificateController::class, 'store'])->name('certificates.store');
    Route::post('/certificates/list', [StudentCertificateController::class, 'showCertificates'])->name('certificates.list');
    Route::get('/certificates/list', [StudentCertificateController::class, 'index'])->name('certificates.list.view');
    Route::delete('/certificates/{id}', [StudentCertificateController::class, 'destroy'])->name('certificates.destroy');
    Route::get('/certificates/search', [StudentCertificateController::class, 'search'])->name('certificates.search');
    Route::get('/certificates/searchData', [StudentCertificateController::class, 'searchCertificate'])->name('searchCertificate');

    // 🔄 Logout Route
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});
