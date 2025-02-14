@extends('layouts.admin')

@section('title')
    <title>Edit Kategori</title>
@endsection

@section('content')
<main class="main">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">Home</li>
        <li class="breadcrumb-item active">Edit Kategori</li>
    </ol>
    <div class="container-fluid">
        <div class="animated fadeIn">
            <div class="row">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Edit Kategori</h4>
                        </div>
                        <div class="card-body">
                          	<!-- ROUTINGNYA MENGIRIMKAN ID CATEGORY YANG AKAN DIEDIT -->
                            <form action="{{ route('matkul.update', $matkul->id) }}" method="post">
                                @csrf
                                @method('PUT')

                                <div class="form-group">
                                    <label for="nm_mk">Mata Kuliah</label>
                                    <input type="text" name="nm_mk" class="form-control" value="{{ $matkul->nm_mk }}" required>
                                    <p class="text-danger">{{ $errors->first('nm_mk') }}</p>
                                </div>
                                <div class="form-group">
                                    <label for="kd_mk">Kode Matkul</label>
                                    <input type="text" name="kd_mk" class="form-control" value="{{ $matkul->kd_mk }}" required>
                                    <p class="text-danger">{{ $errors->first('kd_mk') }}</p>
                                </div>
                                <div class="form-group">
                                    <button class="btn btn-primary btn-sm">Simpan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
