<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EmployeeController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::middleware('guest')->group(function(){
    Route::get('/',[AuthController::class,'viewLoginPage'])->name('viewLoginPage');
    Route::post('/login',[AuthController::class,'postLogin'])->name('postLogin');
});

Route::middleware('auth')->group(function(){
    Route::get('/dashboard',[DashboardController::class,'viewDashboardPage'])->name('viewDashboardPage');
    Route::get('/company/add',[CompanyController::class,'viewAddCompanyPage'])->name('viewAddCompanyPage');
    Route::post('/company/create',[CompanyController::class,'postCreateCompany'])->name('postCreateCompany');
    Route::post('/company/edit',[CompanyController::class,'postEditCompany'])->name('postEditCompany');
    Route::get('/company/edit/{id}',[CompanyController::class,'viewEditCompanyPage'])->name('viewEditCompanyPage');
    

    Route::get('/employee/add',[EmployeeController::class,'viewAddEmployeePage'])->name('viewAddEmployeePage');
    Route::get('/employee/{id}',[EmployeeController::class,'viewEmployeePage'])->name('viewEmployeePage');
    Route::post('/employee/add',[EmployeeController::class,'postAddEmployee'])->name('postAddEmployee');
    Route::get('/employee/edit/{id}',[EmployeeController::class,'viewEditEmployeePage'])->name('viewEditEmployeePage');
    Route::post('/employee/edit',[EmployeeController::class,'postEditEmployee'])->name('postEditEmployee');
    Route::get('/employee/delete/{id}',[EmployeeController::class,'deleteEmployee'])->name('deleteEmployee');
});
