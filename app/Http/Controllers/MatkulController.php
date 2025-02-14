<?php

namespace App\Http\Controllers;
use App\Models\Matkul;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Str;

class MatkulController extends Controller
{
    public function index(){
        $matkul = Matkul::paginate(10);

        return view('dashboard.matkul.index' , compact('matkul'));
    }
    public function store(Request $request){
        $request->validate( [
            'kd_mk' => 'required|string|max:50|unique:matkul,kd_mk',
            'nm_mk' => 'required',
        ]);

        $matkul = Matkul::create([
            'kd_mk' => $request->kd_mk,
            'nm_mk' => $request->nm_mk,
            'slug' => Str::slug($request->nm_mk),
        ]);
        return redirect(route('matkul.index'))->with([
            'success' => 'Mata Kuliah Berhasil Ditambahkan'
        ]);
    }
    public function edit($id){
        $matkul = Matkul::find($id);
        return view('dashboard.matkul.edit', compact('matkul'));
    }
    public function update(Request $request, $id){
        $request->validate( [
            'kd_mk' => 'required|string|max:50|unique:matkul,kd_mk,'.$id,
            'nm_mk' => 'required',
        ]);

        $matkul = Matkul::find($id)->update([
            'kd_mk' => $request->kd_mk,
            'nm_mk' => $request->nm_mk,
        ]);
        return redirect(route('matkul.index'))->with([
            'success' => 'Mata Kuliah Berhasil Diubah'
        ]);
    }
    public function destroy($id){
        $matkul = Matkul::find($id);
        $matkul->delete();
        return redirect(route('matkul.index'))->with([
            'success' => 'Mata Kuliah Berhasil Dihapus'
        ]);
    }
}
