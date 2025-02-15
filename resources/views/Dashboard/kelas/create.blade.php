@extends('layouts.admin')

@section('title')
    <title>Tambah Produk</title>
@endsection

@section('content')
<main class="main">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">Home</li>
        <li class="breadcrumb-item active">Tambah Tamu</li>
    </ol>
    <div class="container-fluid">
        <div class="animated fadeIn">

          	<!-- TAMBAHKAN ENCTYPE="" KETIKA MENGIRIMKAN FILE PADA FORM -->
            <form action="{{ route('kelas.store') }}" method="post" enctype="multipart/form-data" >
                @csrf
                <div class="row">
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Tambah Produk</h4>
                            </div>
                            @if (session('success'))
                                <div class="alert alert-success">{{ session('success') }}</div>
                            @endif
                            @if (session('error'))
                                <div class="alert alert-danger">{{ session('error') }}</div>
                            @endif
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="kelas">Nama Kelas</label>
                                    <input type="text" name="kelas" class="form-control" value="{{ old('kelas') }}" required>
                                    <p class="text-danger">{{ $errors->first('kelas') }}</p>
                                </div>
                                <div class="form-group">
                                    <label for="jurusan">Jurusan</label>
                                    <input type="text" name="jurusan" class="form-control" value="{{ old('jurusan') }}" required>
                                    <p class="text-danger">{{$errors->first('jurusan')}}</p>
                                </div>
                                <div class="form-group">
                                    <label for="angkatan">Angkatan</label>
                                    <input type="text" name="angkatan" class="form-control" value="{{ old('angkatan') }}" required>
                                    <p class="text-danger">{{$errors->first('angkatan')}}</p>
                                </div>
                                <div class="form-group">
                                    <label for="semester">Semester</label>
                                    <input type="text" name="semester" class="form-control" value="{{ old('semester') }}" required>
                                    <p class="text-danger">{{$errors->first('semester')}}</p>
                                </div>
                                <div class="form-group">
                                    <label for="category_id">Mata Kuliah</label>

                                    <!-- DATA KATEGORI DIGUNAKAN DISINI, SEHINGGA SETIAP PRODUK USER BISA MEMILIH KATEGORINYA -->
                                    <select name="matkul_id" class="form-control">
                                        <option value="">Pilih</option>
                                        @foreach ($matkul as $row)
                                        <option value="{{ $row->id }}" {{ old('matkul_id') == $row->id ? 'selected':'' }}>{{ $row->nm_mk }}</option>
                                        @endforeach
                                    </select>
                                    <p class="text-danger">{{ $errors->first('matkul_id') }}</p>
                                </div>

                                <div class="form-group">
                                    <button class="btn btn-primary btn-sm">Tambah</button>
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

<!-- PADA ADMIN LAYOUTS, TERDAPAT YIELD JS YANG BERARTI KITA BISA MEMBUAT SECTION JS UNTUK MENAMBAHKAN SCRIPT JS JIKA DIPERLUKAN -->
@section('js')
    <!-- LOAD CKEDITOR -->
    <script src="https://cdn.ckeditor.com/4.13.0/standard/ckeditor.js"></script>
    <script>
        //TERAPKAN CKEDITOR PADA TEXTAREA DENGAN ID DESCRIPTION
        CKEDITOR.replace('description');
    </script>
@endsection
