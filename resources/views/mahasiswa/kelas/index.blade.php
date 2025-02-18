@extends('mahasiswa.layouts.app')

@section('title')
    <title>List Product</title>
@endsection

@section('content')
<main class="main">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">Home</li>
        <li class="breadcrumb-item active">Tambah Tamu</li>
    </ol>
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif
    <div class="container-fluid">
        <div class="animated fadeIn">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">
                                List Product
                                <!-- BUAT TOMBOL UNTUK MENGARAHKAN KE HALAMAN ADD PRODUK -->
                            </h4>
                        </div>

                            <!-- BUAT FORM UNTUK PENCARIAN, METHODNYA ADALAH GET -->
                            <form action="{{ route('kelasmahasiswa.index') }}" method="get">
                                <div class="input-group mb-3 col-md-3 float-right">
                                    <!-- KEMUDIAN NAME-NYA ADALAH Q YANG AKAN MENAMPUNG DATA PENCARIAN -->
                                    <input type="text" name="q" class="form-control" placeholder="Cari..." value="{{ request()->q }}">
                                    <div class="input-group-append">
                                        <button class="btn btn-secondary" type="button">Cari</button>
                                    </div>
                                </div>
                            </form>

                            <!-- TABLE UNTUK MENAMPILKAN DATA PRODUK -->
                            <div class="table-responsive">
                                <table class="table table-hover table-bordered">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Nama</th>
                                            <th>Jurusan</th>
                                            <th>Mata Kuliah</th>
                                            <th>Dosen</th>
                                            <th>Angkatan</th>
                                            <th>Semester</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($kelas as $row)
                                        <tr>
                                            <td>{{ $row->id }}</td>
                                            <td><strong>{{ $row->kelas }}</strong></td>
                                            <td><strong>{{ $row->jurusan }}</strong></td>
                                            <td><strong>{{ $row->matkul->nm_mk }}</strong></td>
                                            <td><strong>{{ $row->dosen->nama ?? 'Tidak ada Dosen' }}</strong></td>
                                            <td><strong>{{ $row->angkatan }}</strong></td>
                                            <td><strong>{{ $row->semester }}</strong></td>
                                            <td>
                                                @if($row->mahasiswa->contains(auth()->guard('mahasiswa')->user()->id))
                                                        @csrf
                                                        <a href="" class="btn btn-warning btn-sm">Cek Tugas</a>
                                                @else
                                                    <span class="badge bg-secondary">Akses Ditolak</span>
                                                @endif
                                            </td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="8" class="text-center">Tidak ada data</td>
                                        </tr>
                                        @endforelse
                                    </tbody>

                                </table>
                            </div>
                            <!-- MEMBUAT LINK PAGINASI JIKA ADA -->
                            {!! $kelas->links() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
