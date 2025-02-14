<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class HomeMahasiswaController extends Controller
{
    public function index(){
        return view('mahasiswa.home.index');
    }
    public function verifMahasiswaRegistration($token){
        $mahasiswa = Mahasiswa::where( 'activate_token',$token)->first();
        if($mahasiswa){
            $mahasiswa->update([
                'activate_token' => null,
            ]);
            return redirect(route('mahasiswa.login'))->with([
                'success' => 'Akun Berhasil Diverifikasi'
            ]);
        }
        return redirect(route('mahasiswa.login'))->with([
            'error' => 'Token Tidak Valid'
        ]);
    }
}
