@extends('layouts.admin')

@section('title')
    <title>Edit Kelas</title>
@endsection

@section('content')
<main class="main">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">Home</li>
        <li class="breadcrumb-item active">Edit Kelas</li>
    </ol>
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif
    <div class="container-fluid">
        <div class="animated fadeIn">
            <form action="{{ route('dosen.update', $dosen->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Edit Dosen</h4>
                            </div>
                            <div class="card-body">
                                <!-- Nama Kelas -->
                                <div class="form-group">
                                    <label for="nama">Nama</label>
                                    <input type="text" name="nama" class="form-control" value="{{ $dosen->nama }}" required>
                                    <p class="text-danger">{{ $errors->first('nama') }}</p>
                                </div>

                                <!-- Jurusan -->
                                <div class="form-group">
                                    <label for="nidn">NIDN</label>
                                    <input type="text" name="nidn" class="form-control" value="{{ $dosen->nidn }}" required>
                                    <p class="text-danger">{{ $errors->first('nidn') }}</p>
                                </div>

                                <!-- Angkatan -->
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="text" name="email" class="form-control" value="{{ $dosen->email }}" required>
                                    <p class="text-danger">{{ $errors->first('email') }}</p>
                                </div>

                                <!-- Password -->
                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <input type="password" name="password" class="form-control">
                                    <p class="text-danger">{{ $errors->first('password') }}</p>
                                </div>

                                <!-- Tombol Submit -->
                                <div class="form-group">
                                    <button class="btn btn-primary btn-sm">Update</button>
                                </div>

                            </div> <!-- card-body selesai di sini -->
                        </div> <!-- card selesai di sini -->
                    </div> <!-- col-md-8 selesai di sini -->
                </div> <!-- row selesai di sini -->
            </form>
        </div>
    </div>
</main>
@endsection
