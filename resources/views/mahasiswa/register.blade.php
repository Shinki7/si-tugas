<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Registrasi Mahasiswa</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
</head>
<body>
<style>
    a {
        text-decoration: none;
    }
    .register-page {
        width: 100%;
        height: 100vh;
        display: flex;
        align-items: center;
    }
</style>
<div class="register-page bg-light">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="bg-white shadow rounded p-4">
                    <h3 class="text-center mb-4">Registrasi Mahasiswa</h3>

                    @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                    @endif
                    @if (session('error'))
                    <div class="alert alert-danger">{{ session('error') }}</div>
                    @endif

                    <form action="{{ route('register.mahasiswa') }}" method="POST" class="row g-3">
                        @csrf
                        <div class="col-12">
                            <label>Nama<span class="text-danger">*</span></label>
                            <div class="input-group">
                                <div class="input-group-text"><i class="bi bi-person-fill"></i></div>
                                <input type="text" name="nama" value="{{ old('nama') }}" class="form-control @error('nama') is-invalid @enderror">
                                @error('nama')
                                    <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-12">
                            <label>NIM<span class="text-danger">*</span></label>
                            <div class="input-group">
                                <div class="input-group-text"><i class="bi bi-card-list"></i></div>
                                <input type="text" name="nim" value="{{ old('nim') }}" class="form-control @error('nim') is-invalid @enderror">
                                @error('nim')
                                    <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-12">
                            <label>Jurusan<span class="text-danger">*</span></label>
                            <div class="input-group">
                                <div class="input-group-text"><i class="bi bi-book-fill"></i></div>
                                <input type="text" name="jurusan" value="{{ old('jurusan') }}" class="form-control @error('jurusan') is-invalid @enderror">
                                @error('jurusan')
                                    <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-12">
                            <label>Angkatan<span class="text-danger">*</span></label>
                            <div class="input-group">
                                <div class="input-group-text"><i class="bi bi-calendar"></i></div>
                                <input type="text" name="angkatan" value="{{ old('angkatan') }}" class="form-control @error('angkatan') is-invalid @enderror">
                                @error('angkatan')
                                    <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-12">
                            <label>Email<span class="text-danger">*</span></label>
                            <div class="input-group">
                                <div class="input-group-text"><i class="bi bi-envelope-fill"></i></div>
                                <input type="email" name="email" value="{{ old('email') }}" class="form-control @error('email') is-invalid @enderror">
                                @error('email')
                                    <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-12">
                            <label>Password<span class="text-danger">*</span></label>
                            <div class="input-group">
                                <div class="input-group-text"><i class="bi bi-lock-fill"></i></div>
                                <input type="password" name="password" value="{{ old('password') }}" class="form-control @error('password') is-invalid @enderror">
                                @error('password')
                                    <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-12">
                            <button type="submit" class="btn btn-primary w-100">Daftar</button>
                        </div>
                    </form>

                    <p class="text-center mt-3">
                        Sudah punya akun? <a href="{{ route('mahasiswa.login') }}">Login di sini</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
