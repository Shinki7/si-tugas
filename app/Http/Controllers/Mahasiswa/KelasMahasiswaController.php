<?php

namespace App\Http\Controllers\Mahasiswa;

use Illuminate\Http\Request;
use App\Models\Kelas;
use App\Model\Mahasiswa;
use Illuminate\Routing\Controller;

class KelasMahasiswaController extends Controller
{
    public function index(){
        $mahasiswa = auth()->guard('mahasiswa')->user();

        if (!$mahasiswa) {
            return redirect()->route('mahasiswa.login')->with('error', 'Silakan login terlebih dahulu.');
        }

        $kelas = Kelas::with('matkul', 'dosen')
            ->whereHas('mahasiswa', function ($query) use ($mahasiswa) {
                $query->where('mahasiswa_id', $mahasiswa->id);
            })
            ->paginate(10);

        return view('mahasiswa.kelas.index', compact('kelas'));
    }

    public function show($id){
        $kelas = Kelas::with('matkul', 'dosen')->findOrFail($id);
        return view('mahasiswa.kelas.show', compact('kelas'));
    }
}
