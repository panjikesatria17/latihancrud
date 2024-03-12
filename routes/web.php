<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeeController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/pegawai',[EmployeeController::class, 'index'])->name('pegawai');

Route::get('/tambahpegawai',[EmployeeController::class, 'tambahpegawai'])->name('tambahpegawai');
Route::post('/insertdata',[EmployeeController::class, 'insertdata'])->name('insertdata');

Route::get('/tampildata/{id}',[EmployeeController::class, 'tampildata'])->name('tampildata');
Route::post('/updatedata/{id}',[EmployeeController::class, 'updatedata'])->name('updatedata');

Route::get('/delete/{id}',[EmployeeController::class, 'delete'])->name('delete');

//expoert pdf
Route::get('/exportpdf',[EmployeeController::class, 'exportpdf'])->name('exportpdf');

//export excel
Route::get('/exportexcel',[EmployeeController::class, 'exportexcel'])->name('exportexcel');

// Import Excel
Route::post('/importexcel',[EmployeeController::class, 'importexcel'])->name('importexcel');
