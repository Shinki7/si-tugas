<?php

namespace App\Http\Controllers\Dosen;

use Illuminate\Routing\Controller;
use App\Models\Dosen;
use Illuminate\Http\Request;

class LoginDosenController extends Controller
{
    public function index(){
        if(auth()->guard('dosen')->check()) return redirect(route('dosen.index'));
        return view('dosen.login');
    }
    public function login(Request $request){

        $request->validate( [
            'nidn' => 'required|nidn|exists:dosen,nidn',
            'password' => 'required',
        ]);

        $auth = $request->only('nidn', 'password');
        if (auth()->guard('dosen')->attempt($auth)) {
            return redirect()->route('dosen.index');
        }
        return redirect()->back()->withErrors([
            'error' => 'nidn atau password salah'
        ]);
    }

    public function logout(){
        auth()->guard('dosen')->logout();
        return redirect()->route('dosen.login');
    }
}
