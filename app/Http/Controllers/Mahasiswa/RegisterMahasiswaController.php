<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Auth\Events\Registered;
use Mail;
use Illuminate\Routing\Controller;
use App\Mail\MahasiswaRegisterMail;
use DB;
use Illuminate\Support\Str;

class RegisterMahasiswaController extends Controller
{
    public function RegisterForm(){
        return view('mahasiswa.register');
    }
    public function Register(Request $request){
        $request->validate([
            'nama'=>'required',
            'nim'=>'required',
            'angkatan'=>'required',
            'jurusan'=>'required',
            'email'=>'required|email|unique:mahasiswa,email',
            'password'=>'required',
        ]);
        try {
            $mahasiswa = Mahasiswa::where('email', $request->email)->first();
            if (!auth()->guard('mahasiswa')->check() && $mahasiswa) {
                return redirect()->back()->with([
                    'error' => 'Email Sudah Terdaftar'
                ]);
            }
            $mahasiswa = Mahasiswa::create([
                'nama' => $request->nama,
                'nim' => $request->nim,
                'angkatan' => $request->angkatan,
                'jurusan' => $request->jurusan,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'activate_token' => Str::random(30),
            ]);
            if(!auth()->guard('mahasiswa')->check()){
                Mail::to($request->email)->send(new MahasiswaRegisterMail($mahasiswa));
        }return redirect()->back()->with(['success' => 'Silahkan Cek Email Anda Untuk Verifikasi Akun, Jika Tidak ada Email, Mungkin Email Salah.']);
    }catch (\Exception $e) {
        DB::rollback();
        return redirect()->back()->with(['error' => $e->getMessage()]);
    }
    }
}
