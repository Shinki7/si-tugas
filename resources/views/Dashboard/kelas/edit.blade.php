@extends('layouts.admin')

@section('title')
    <title>Edit Produk</title>
@endsection

@section('content')
<main class="main">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">Home</li>
        <li class="breadcrumb-item active">Tambah Tamu</li>
    </ol>
    <div class="container-fluid">
        <div class="animated fadeIn">
            <form action="{{ route('kelas.update', $kelas->id) }}" method="post" enctype="multipart/form-data" >
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Edit Produk</h4>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="kelas">Nama Kelas</label>
                                    <input type="text" name="kelas" class="form-control" value="{{ $kelas->kelas }}" required>
                                    <p class="text-danger">{{ $errors->first('name') }}</p>
                                </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="jurusan">Jurusan</label>
                                    <input type="text" name="jurusan" class="form-control" value="{{ $kelas->jurusan }}" required>
                                   <p class="text-danger">{{ $errors->first('jurusan') }}</p>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="angkatan">Angkatan</label>
                                    <input type="text" name="angkatan" class="form-control" value="{{ $kelas->angkatan }}" required>
                                    <p class="text-danger">{{ $errors->first('angkatan') }}</p>
                          </div>
                          <div class="card-body">
                                <div class="form-group">
                                   <label for="semester">Semester</label>
                                   <input type="text" name="semester" class="form-control" value="{{ $kelas->semester }}" required>
                                   <p class="text-danger">{{ $errors->first('semester') }}</p>
                           </div>
                           <div class="form-group">
                            <label for="category_id">Mata Kuliah</label>

                            <!-- DATA KATEGORI DIGUNAKAN DISINI, SEHINGGA SETIAP PRODUK USER BISA MEMILIH KATEGORINYA -->
                            <select name="matkul_id" class="form-control">
                                <option value="">Pilih</option>
                                @foreach ($matkul as $row)
                                <option value="{{ $row->id }}" {{ old('matkul_id', $kelas->matkul_id) == $row->id ? 'selected':'' }}>{{ $row->nm_mk }}</option>
                                @endforeach
                            </select>
                            <p class="text-danger">{{ $errors->first('matkul_id') }}</p>
                            </div>
                                <div class="form-group">
                                    <button class="btn btn-primary btn-sm">Update</button>
                                </div>
                            </div>
                        </div>
                    </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</main>
@endsection

@section('js')
    <script src="https://cdn.ckeditor.com/4.13.0/standard/ckeditor.js"></script>
    <script>
        CKEDITOR.replace('description');
    </script>
@endsection
