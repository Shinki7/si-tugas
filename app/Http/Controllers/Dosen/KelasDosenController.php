<?php

namespace App\Http\Controllers\Dosen;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Models\Kelas;
use App\Models\Matkul;
use App\Models\Mahasiswa;
use App\Models\Dosen;

class KelasDosenController extends Controller
{
    public function index()
{
    $dosen = auth()->guard('dosen')->user();


    // Pastikan user sudah login
    if (!$dosen) {
        return redirect()->route('dosen.login')->with('error', 'Silakan login terlebih dahulu.');
    }

    $kelas = Kelas::with('matkul', 'dosen')
                  ->where('dosen_id', $dosen->id)
                  ->paginate(10);

    return view('dosen.kelas.index', compact('kelas'));
}


public function create(){
    $matkul = Matkul::orderBy('nm_mk', 'DESC')->get();
    return view('dosen.kelas.create', compact('matkul'));
}
public function store(Request $request)
{
    $request->validate([
        'kelas' => 'required',
        'matkul_id' => 'required|exists:matkul,id',
        'jurusan' => 'required',
        'angkatan' => 'required',
        'semester' => 'required',
    ]);
    Kelas::create([
        'kelas' => $request->kelas,
        'matkul_id' => $request->matkul_id,
        'dosen_id' => auth()->guard('dosen')->user()->id, // Set dosen_id sesuai yang login
        'jurusan' => $request->jurusan,
        'angkatan' => $request->angkatan,
        'semester' => $request->semester,
    ]);
    return redirect()->route('kelasdosen.index')->with('success', 'Kelas Berhasil Ditambahkan');
}

    public function edit($id){
        $kelas = Kelas::where('id', $id)
                  ->where('dosen_id', auth()->guard('dosen')->user()->id) // Pastikan hanya dosen terkait
                  ->firstOrFail(); // Jika tidak ditemukan, akan 404
        $matkul = Matkul::All();
    return view('dosen.kelas.edit', compact('kelas', 'matkul'));
    }

    public function update(Request $request, $id){
        $request->validate([
            'kelas' => 'required',
            'matkul_id' => 'required|exists:matkul,id',
            'jurusan' => 'required',
            'angkatan' => 'required',
            'semester' => 'required',
        ]);
        $kelas = Kelas::where('id', $id)
                  ->where('dosen_id', auth()->guard('dosen')->user()->id) // Pastikan hanya dosen terkait
                  ->firstOrFail(); // Jika tidak ditemukan, akan 404
        $kelas->update([
            'kelas' => $request->kelas,
            'matkul_id' => $request->matkul_id,
            'jurusan' => $request->jurusan,
            'angkatan' => $request->angkatan,
            'semester' => $request->semester,
        ]);
        return redirect()->route('kelasdosen.index')->with('success', 'Kelas Berhasil Diperbarui');
    }

    public function destroy($id){
        $kelas = Kelas::where('id', $id)
                  ->where('dosen_id', auth()->guard('dosen')->user()->id) // Pastikan hanya dosen terkait
                  ->firstOrFail(); // Jika tidak ditemukan, akan 404
        $kelas->delete();
        return redirect()->route('kelasdosen.index')->with('success', 'Kelas Berhasil Dihapus');
    }

    public function listSiswa($kelas_id){
        $kelas = Kelas::with('mahasiswa')->findOrFail($kelas_id);
        return view('dosen.kelas.listsiswa', compact('kelas'));
    }
    public function removeSiswa($kelas_id, $mahasiswa_id)
    {
        $kelas = Kelas::findOrFail($kelas_id);
        $kelas->mahasiswa()->detach($mahasiswa_id);

        return redirect()->route('kelasdosen.listsiswa', $kelas_id)->with('success', 'Mahasiswa berhasil dihapus dari kelas.');
    }
    public function show($id){
        $siswa = Mahasiswa::All();
        return view('dosen.kelas.inputsiswa', compact('siswa', 'id'));
    }
    public function inputsiswa(Request $request, $id){
        $request->validate([
            'mahasiswa_id' => 'required|array',
            'mahasiswa_id.*' => 'exists:mahasiswa,id',
        ]);
        try {
            $kelas = Kelas::findOrFail($id);

            // Ambil mahasiswa yang sudah ada di kelas ini
            $existingMahasiswa = $kelas->mahasiswa()->whereIn('mahasiswa_id', $request->mahasiswa_id)->pluck('mahasiswa_id')->toArray();

            // Cek apakah ada mahasiswa yang sudah terdaftar
            if (!empty($existingMahasiswa)) {
                return redirect()->back()->with([
                    'error' => 'mahasiswa sudah terdaftar di kelas ini.'
                ]);
            }

            // Jika belum terdaftar, tambahkan mahasiswa ke kelas
            $kelas->mahasiswa()->attach($request->mahasiswa_id);

            return redirect()->route('kelasdosen.listsiswa', $id)->with('success', 'Mahasiswa berhasil ditambahkan ke kelas.');

        } catch (\Exception $e) {
            return redirect()->back()->with([
                'error' => 'Terjadi kesalahan saat menambahkan mahasiswa.'
            ]);
        }
    }
}
