<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KelasController;

Route::get('login', [AuthController::class, 'index'])->name('admin.login');
Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function (){
    Route::get('home', [HomeController::class, 'index'])->name('admin.home');
    Route::resource('kelas', 'App\Http\Controllers\KelasController');
    Route::resource('matkul', 'App\Http\Controllers\MatkulController');
    Route::post('/kelas/{id}/inputsiswa', [KelasController::class, 'inputsiswa'])->name('kelas.inputsiswa');

});
Route::post('admin-login', [AuthController::class, 'login'])->name('login.admin');
Route::get('logout', [AuthController::class, 'logout'])->name('logout');
