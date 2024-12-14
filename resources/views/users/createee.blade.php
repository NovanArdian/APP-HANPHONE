@extends('templates.app') <!-- Mengextends template layout utama -->

@section('content-dinamis') <!-- Bagian untuk konten dinamis -->
<form action="{{ route('kelola_akun.tambah.proses')}}" class="card p-5" method="POST"> <!-- Form untuk menambah akun dengan method POST -->
    @csrf <!-- Token CSRF untuk keamanan -->
    
    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if (Session::get('success')) <!-- Cek jika ada pesan sukses dalam session -->
    <div class="alert alert-success"> <!-- Menampilkan alert berwarna hijau untuk sukses -->
        {{ Session::get('success')}} <!-- Menampilkan pesan sukses -->
    </div>
    @endif

    <div class="mb-3 row"> <!-- Baris untuk elemen nama -->
        <label for="name" class="col-sm-2 col-form-label">Nama: </label> <!-- Label untuk input nama -->
        <div class="col-sm-10"> <!-- Kontainer untuk input nama -->
            <input type="text" class="form-control" id="name" name="name" > <!-- Input untuk nama pengguna, ditandai wajib diisi -->
        </div>
    </div>
    
    <div class="mb-3 row"> <!-- Baris untuk elemen role -->
        <label for="type" class="col-sm-2 col-form-label">Role: </label> <!-- Label untuk dropdown role -->
        <div class="col-sm-10"> <!-- Kontainer untuk dropdown role -->
            <select class="form-select" name="role" id="role" > <!-- Dropdown untuk memilih role pengguna, ditandai wajib diisi -->
                <option selected disabled hidden>Pilih</option> <!-- Opsi default yang tidak bisa dipilih -->
                <option value="admin" {{old('role') == "admin" ? "selected" : ''}} >admin</option> <!-- Opsi untuk Admin, terpilih jika input lama adalah admin -->
                <option value="kasir"  {{old('role') == "kasir" ? "selected" : ''}}>kasir</option> <!-- Opsi untuk Kasir, terpilih jika input lama adalah kasir -->
            </select>
        </div>
    </div>
    
    <div class="mb-3 row"> <!-- Baris untuk elemen email -->
        <label for="email" class="col-sm-2 col-form-label">Email: </label> <!-- Label untuk input email -->
        <div class="col-sm-10"> <!-- Kontainer untuk input email -->
            <input type="email" class="form-control" id="email" name="email" value="{{old('email')}}" > <!-- Input untuk email pengguna, ditandai wajib diisi, dengan nilai lama jika ada kesalahan -->
        </div>
    </div>
    
    <div class="mb-3 row"> <!-- Baris untuk elemen password -->
        <label for="password" class="col-sm-2 col-form-label">Password: </label> <!-- Label untuk input password -->
        <div class="col-sm-10"> <!-- Kontainer untuk input password -->
            <input type="password" class="form-control" id="password" name="password"  placeholder="Masukkan password"> <!-- Input untuk password pengguna, ditandai wajib diisi -->
        </div>
    </div>
    
    <button type="submit" class="btn btn-primary mt-3">Kirim</button> <!-- Tombol untuk mengirim form -->
</form>
@endsection
