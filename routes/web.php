<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

Route::middleware('auth')->group(function () {
  Route::get('payrolls/payment_detail_pdf/{id}', [App\Http\Controllers\PayrollController::class, 'paymentDetailPdf'])->name('payrolls.payment_detail_pdf');
  Route::get('/', [App\Http\Controllers\Controller::class, 'index'])->name('index');
  Route::resource('employees', App\Http\Controllers\EmployeeController::class);
  Route::resource('positions', App\Http\Controllers\PositionController::class);
  Route::get('payrolls/add/{id}', [App\Http\Controllers\PayrollController::class, 'addPayroll'])->name('payrolls.add');
  Route::post('payrolls/pay_salary/{id}', [App\Http\Controllers\PayrollController::class, 'paySalary'])->name('payrolls.pay_salary');
  Route::get('payrolls/payment_detail_pdf/{id}', [App\Http\Controllers\PayrollController::class, 'paymentDetailPdf'])->name('payrolls.payment_detail_pdf');
  Route::resource('payrolls', App\Http\Controllers\PayrollController::class);
  Route::resource('attendances', App\Http\Controllers\AttendanceController::class);
});

