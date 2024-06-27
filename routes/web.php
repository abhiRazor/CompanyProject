<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\EmailController;

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


Route::get('/',[CompanyController::class,'index']);
Route::post('submit',[CompanyController::class,'login']);
Route::get('/registration',[CompanyController::class,'registration']);

Route::post('/registration_save',[CompanyController::class,'registration_save']);

Route::get('/dashboard',[CompanyController::class,'dashboard']);

Route::post('/logout', [CompanyController::class, 'logout'])->name('logout');
//-----------------------------------------------------------------------------------------------
// //--------------------------------(Task)-------------------------------------------------//
// Route::resource('tasks', TaskController::class);
Route::get('tasks.create',[TaskController::class,'create']);

Route::post('tasks.store',[TaskController::class,'store']);

Route::get('edit/{id}',[TaskController::class,'edit']);

Route::put('tasks/update/{id}',[TaskController::class,'update']);

Route::delete('tasks/{id}', [TaskController::class, 'destroy']);

//--------------------------------------(forgetPassword)-------------------------------------//

Route::get('forget/Password',[EmailController::class,'forget_password']);

Route::post('email/page',[EmailController::class,'sendEmail']);

Route::post('otp/password',[EmailController::class,'resetPasswordWithOtp']);

Route::post('reset/password/{user}',[EmailController::class,'resetPassword']);
