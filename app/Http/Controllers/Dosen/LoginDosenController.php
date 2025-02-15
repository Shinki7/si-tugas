<?php

namespace App\Http\Controllers\Dosen;

use Illuminate\Routing\Controller;
use App\Models\Dosen;
use Illuminate\Http\Request;

class LoginDosenController extends Controller
{
    public function index(){
        if(auth()->guard('dosen')->check()) return redirect(route('dosen.dashboard'));
        return view('dosen.login');
    }
    public function login(Request $request){

        $request->validate( [
            'nidn' => 'required|exists:dosen,nidn',
            'password' => 'required',
        ]);

        $auth = $request->only('nidn', 'password');
        if (auth()->guard('dosen')->attempt($auth)) {
            return redirect()->route('dosen.dashboard');
        }
        return back()->with([
            'LoginError' => 'nidn atau password salah'
        ]);
    }

    public function logout(){
        auth()->guard('dosen')->logout();
        return redirect()->route('dosen.login');
    }
}
