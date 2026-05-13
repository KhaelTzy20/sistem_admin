<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\TabunganController;
use App\Http\Controllers\EquityController;
use App\Http\Controllers\SummaryController;

Route::get('/test', function () {
    return 'OK';
});

Route::get('/users/{id}', function($id) {
    return \App\Models\User::find($id);
});

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth');

Route::get('/forgot-password', [ForgotPasswordController::class, 'showForm']);
Route::post('/forgot-password', [ForgotPasswordController::class, 'sendResetLink']);

Route::get('/reset-password/{token}', [ForgotPasswordController::class, 'showResetForm']);
Route::post('/reset-password', [ForgotPasswordController::class, 'resetPassword']);

Route::get('/employees', [EmployeeController::class, 'index'])
    ->name('employees.index')
    ->middleware('auth');
Route::get('/employees/create', [EmployeeController::class, 'create'])->middleware('auth');
Route::post('/employees', [EmployeeController::class, 'store'])->middleware('auth');
Route::get('/employees/tabungan', [TabunganController::class, 'index'])
    ->name('employees.tabungan')
    ->middleware('auth');
Route::get('/employees/tabungan/{id}/edit', [TabunganController::class, 'edit'])
    ->name('tabungan.edit')
    ->middleware('auth');

Route::post('/employees/tabungan/{id}', [TabunganController::class, 'update'])
    ->name('tabungan.update')
    ->middleware('auth');

Route::get('/employees/{id}/edit', [EmployeeController::class, 'edit'])
    ->name('employees.edit')
    ->middleware('auth');

Route::put('/employees/{id}', [EmployeeController::class, 'update'])
    ->name('employees.update')
    ->middleware('auth');

Route::resource('/employees/equity', EquityController::class)
    ->middleware('auth');

Route::get('/employees/summary', [SummaryController::class, 'index'])
    ->name('employees.summary')
    ->middleware('auth');

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
