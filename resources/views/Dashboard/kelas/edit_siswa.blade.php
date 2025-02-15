@extends('layouts.admin')

@section('title')
    <title>Tambah Mahasiswa ke Kelas</title>
@endsection

@section('content')
<main class="main">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">Home</li>
        <li class="breadcrumb-item active">Tambah Mahasiswa ke Kelas</li>
    </ol>
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif
    <div class="container-fluid">
        <div class="animated fadeIn">
            <form action="{{ route('kelas.removesiswa', $id) }}" method="post">
                @csrf
                <div class="row">
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Tambah Mahasiswa ke Kelas</h4>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="search">Cari Mahasiswa</label>
                                    <input type="text" id="search" class="form-control" placeholder="Cari berdasarkan nama atau NIM...">
                                </div>
                                <div class="form-group">
                                    <label for="mahasiswa_id">Pilih Mahasiswa</label>
                                    <select name="mahasiswa_id[]" id="mahasiswa_id" class="form-control" multiple>
                                        @foreach($siswa as $mhs)
                                            <option value="{{ $mhs->id }}">{{ $mhs->nama }} ({{ $mhs->nim }})</option>
                                        @endforeach
                                    </select>
                                    <p class="text-danger">{{ $errors->first('mahasiswa_id') }}</p>
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

@section('js')
    <script>
        document.getElementById("search").addEventListener("keyup", function() {
            let searchValue = this.value.toLowerCase();
            let options = document.getElementById("mahasiswa_id").options;

            for (let option of options) {
                let text = option.text.toLowerCase();
                option.style.display = text.includes(searchValue) ? "block" : "none";
            }
        });
    </script>
@endsection
