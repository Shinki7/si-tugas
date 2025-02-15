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
    Route::get('/kelas/{kelas_id}/mahasiswa', [KelasController::class, 'listSiswa'])->name('kelas.listsiswa');
Route::get('/kelas/{kelas_id}/mahasiswa/{mahasiswa_id}/edit', [KelasController::class, 'editSiswa'])->name('kelas.editsiswa');
Route::delete('/kelas/{kelas_id}/mahasiswa/{mahasiswa_id}', [KelasController::class, 'removeSiswa'])->name('kelas.removesiswa');

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

Route::group(['prefix' => 'Dosen',], function () {
    Route::get('login', [App\Http\Controllers\Dosen\LoginDosenController::class, 'index'])->name('dosen.login');
    Route::post('login-dosen', [App\Http\Controllers\Dosen\LoginDosenController::class, 'login'])->name('login.dosen');
    Route::get('logout', [App\Http\Controllers\Dosen\LoginDosenController::class, 'logout'])->name('dosen.logout');
});
