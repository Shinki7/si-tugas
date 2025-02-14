<?php

namespace App\Http\Controllers;
use App\Models\Kelas;
use App\Models\Matkul;
use App\Models\Mahasiswa;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class KelasController extends Controller
{
    public function index(){
        $kelas = Kelas::with('matkul')->paginate(10);

        return view('dashboard.kelas.index', compact('kelas'));
    }

    public function create(){
        $matkul = Matkul::orderBy('nm_mk', 'DESC')->get();

        return view('dashboard.kelas.create', compact( 'matkul'));
    }

    public function store(Request $request){
        $request->validate([
            'kelas' => 'required',
            'matkul_id' => 'required|exists:matkul,id',
            'jurusan' => 'required',
            'angkatan' => 'required',
            'semester' => 'required',
        ]);

        $kelas=Kelas::create([
            'kelas' => $request->kelas,
            'matkul_id' => $request->matkul_id,
            'jurusan' => $request->jurusan,
            'angkatan' => $request->angkatan,
            'semester' => $request->semester,
        ]);
        return redirect(route('kelas.index'))->with([
            'success' => 'Kelas Berhasil Ditambahkan']);
    }
    public function edit($id){
        $kelas = Kelas::find($id);
        $matkul = Matkul::All();
        return view('dashboard.kelas.edit', compact('kelas', 'matkul'));
    }
    public function update(Request $request, $id){
        $request->validate( [
            'kelas' => 'required',
            'jurusan' => 'required',
            'angkatan' => 'required',
            'semester' => 'required',
        ]);

        $kelas = Kelas::find($id);
        $data = [
            'kelas' => $request->kelas,
            'jurusan' => $request->jurusan,
            'angkatan' => $request->angkatan,
            'semester' => $request->semester,
        ];
        if ($request->has('matkul_id') && !is_null($request->matkul_id)) {
            $data['matkul_id'] = $request->matkul_id;
        }

        $kelas->update($data);

        return redirect(route('kelas.index'))->with(['success'=>'Kelas Diperbarui']);
    }
    public function show($id){
        $siswa = Mahasiswa::All();

        return view('dashboard.kelas.inputsiswa', compact('siswa', 'id'));
    }
    public function inputsiswa(Request $request, $id){
        $request->validate([
            'mahasiswa_id' => 'required|array',
            'mahasiswa_id.*' => 'exists:mahasiswa,id',
        ]);

        $kelas = Kelas::findOrFail($id);
        $kelas->mahasiswa()->attach($request->mahasiswa_id);

        return redirect(route('kelas.index'))->with(['success' => 'Mahasiswa Berhasil Ditambahkan']);
    }
    public function destroy($id){
        $kelas = Kelas::findOrFail($id);
        $kelas->delete();
        return redirect(route('kelas.index'))->with(['success'=>'Kelas Dihapus']);
    }

}
