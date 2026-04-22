<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\PeminjamanController;

Route::get('/test', function () {
    return 'OK';
});

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth');

Route::get('/forgot-password', [ForgotPasswordController::class, 'showForm']);
Route::post('/forgot-password', [ForgotPasswordController::class, 'sendResetLink']);

Route::get('/reset-password/{token}', [ForgotPasswordController::class, 'showResetForm']);
Route::post('/reset-password', [ForgotPasswordController::class, 'resetPassword']);

Route::get('/employees', [EmployeeController::class, 'index'])->middleware('auth');
Route::get('/employees/create', [EmployeeController::class, 'create'])->middleware('auth');
Route::post('/employees', [EmployeeController::class, 'store'])->middleware('auth');
Route::get('/employees/{id}', [EmployeeController::class, 'show'])
    ->name('employees.show')
    ->middleware('auth');

Route::resource('/inventaris', ItemController::class)->middleware('auth');

Route::resource('/peminjaman', PeminjamanController::class)->middleware('auth');
Route::post('/peminjaman/{id}/kembalikan', [PeminjamanController::class, 'kembalikan'])
    ->name('peminjaman.kembalikan')
    ->middleware('auth');
Route::get('/peminjaman/{id}/kembalikan', [PeminjamanController::class, 'formKembalikan'])->name('peminjaman.formKembalikan');
Route::post('/peminjaman/{id}/kembalikan', [PeminjamanController::class, 'prosesKembalikan'])->name('peminjaman.prosesKembalikan');

Route::get('/', function () {
    return redirect('/employees');
});
