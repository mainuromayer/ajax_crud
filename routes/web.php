<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\DepartmentController;

Route::get('/', function () {
    return view('dashboard');
})->name('dashboard');

Route::get('/employeePage', [EmployeeController::class, 'employeePage'])->name('employee.page');
Route::get('/departmentPage', [DepartmentController::class, 'departmentPage'])->name('department.page');

Route::get('/departments', [DepartmentController::class, 'list'])->name('department.list');
Route::post('/department/create', [DepartmentController::class, 'create'])->name('department.create');
Route::post('/department/update', [DepartmentController::class, 'update'])->name('department.update');
Route::post('/department/delete', [DepartmentController::class, 'delete'])->name('department.delete');

Route::get('/employees', [EmployeeController::class, 'list'])->name('employee.list');
Route::post('/employee/create', [EmployeeController::class, 'create'])->name('employee.create');
Route::post('/employee/update', [EmployeeController::class, 'update'])->name('employee.update');
Route::post('/employee/delete', [EmployeeController::class, 'delete'])->name('employee.delete');


