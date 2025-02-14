<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\Mahasiswa\RegisterMahasiswaController;
use App\Http\Controllers\Mahasiswa\HomeMahasiswaController;
use App\Http\Controllers\Mahasiswa\LoginMahasiswaController;

Route::get('admin/login', [AuthController::class, 'index'])->name('admin.login');
Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function (){
    Route::get('home', [HomeController::class, 'index'])->name('admin.home');
    Route::resource('kelas', 'App\Http\Controllers\KelasController');
    Route::resource('matkul', 'App\Http\Controllers\MatkulController');
    Route::post('/kelas/{id}/inputsiswa', [KelasController::class, 'inputsiswa'])->name('kelas.inputsiswa');

});

Auth::routes();

Route::post('admin-login', [AuthController::class, 'login'])->name('login.admin');
Route::get('logout', [AuthController::class, 'logout'])->name('logout.admin');

Route::group(['prefix' => 'Mahasiswa',], function () {
    Route::get('home', [HomeMahasiswaController::class, 'index'])->name('mahasiswa.index');
    Route::get('login', [LoginMahasiswaController::class, 'index'])->name('mahasiswa.login');
    Route::post('login-mahasiswa',[LoginMahasiswaController::class, 'login'])->name('login.mahasiswa');
    Route::get('logout',[LoginMahasiswaController::class, 'logout'])->name('mahasiswa.logout');
    Route::get('register', [RegisterMahasiswaController::class, 'RegisterForm'])->name('show.register');
    Route::post('register-mahasiswa', [RegisterMahasiswaController::class, 'Register'])->name('register.mahasiswa');
    Route::get('verify/{token}', [HomeMahasiswaController::class, 'verifMahasiswaRegistration'])->name('mahasiswa.verify');
});
