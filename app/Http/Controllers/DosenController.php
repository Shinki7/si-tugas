<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Routing\Controller;

class DosenController extends Controller
{
    public function index(){
        $dosen = Dosen::paginate(10);
        return view('dashboard.dosen.index', compact('dosen'));
    }

    public function create(){
        return view('dashboard.dosen.create');
    }
    public function store(Request $request){
        $request->validate([
            'nidn' => 'required|unique:dosen,nidn',
            'nama' => 'required',
            'email' => 'required|email|unique:dosen,email',
            'password' => 'required',
        ]);

        Dosen::create([
            'nidn' => $request->nidn,
            'nama' => $request->nama,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);
        return redirect()->route('dosen.index');
    }
    public function edit($id){
        $dosen = Dosen::find($id);
        return view('dashboard.dosen.edit', compact('dosen'));
    }
    public function update(Request $request, $id){
        $request->validate([
            'nidn' => 'required|unique:dosen,nidn,'.$id,
            'nama' => 'required',
            'email' => 'required|email|unique:dosen,email,'.$id,
            'password' => 'nullable|min:6', // Password tidak wajib diisi
        ]);

        $dosen = Dosen::find($id);
        $dosen->nidn = $request->nidn;
        $dosen->nama = $request->nama;
        $dosen->email = $request->email;

        // Update password hanya jika diisi
        if ($request->password) {
            $dosen->password = bcrypt($request->password);
        }

        $dosen->save();

        return redirect()->route('dosen.index')->with('success', 'Dosen berhasil diperbarui.');
    }

    public function destroy($id){
        $dosen = Dosen::find($id);
        $dosen->delete();
        return redirect()->route('dosen.index');
    }
}
