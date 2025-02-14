<?php

namespace App\Http\Controllers\Mahasiswa;
use Illuminate\Http\Request;
use App\Models\Mahasiswa;
use Illuminate\Routing\Controller;

class LoginMahasiswaController extends Controller
{
    public function index(){
        if(auth()->guard('mahasiswa')->check()) return redirect(route('mahasiswa.home'));
        return view('mahasiswa.login');
    }

    public function login(Request $request){

        $request->validate( [
            'email' => 'required|email|exists:mahasiswa,email',
            'password' => 'required',
        ]);

        $auth = $request->only('email', 'password');
        if (auth()->guard('mahasiswa')->attempt($auth)) {
            return redirect()->route('mahasiswa.index');
        }
        return redirect()->back()->withErrors([
            'error' => 'email atau password salah'
        ]);
}
    public function logout(){
        auth()->guard('mahasiswa')->logout();
        return redirect()->route('mahasiswa.login');
    }

}
