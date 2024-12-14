@extends('templates.app') <!-- Mengextends template layout utama -->

@section('content-dinamis') <!-- Bagian untuk konten dinamis -->
<div class="container">
    <h1>Edit Akun</h1> <!-- Judul halaman untuk mengedit akun -->

    <form action="{{ route('kelola_akun.ubah.proses', $user->id) }}" method="POST"> <!-- Form untuk mengedit akun -->
        @csrf <!-- Token CSRF untuk keamanan -->
        @method('PATCH') <!-- Metode spoofing untuk PATCH, digunakan untuk memperbarui data -->
        
        <div class="form-group"> <!-- Kontainer untuk elemen form -->
            <label for="name">Nama</label> <!-- Label untuk input nama -->
            <input type="text" name="name" class="form-control" value="{{ $user->name }}" required> <!-- Input untuk nama pengguna, dengan nilai awal dari objek pengguna -->
        </div>
        <br>
        
        <div class="form-group"> <!-- Kontainer untuk elemen form -->
            <label for="email">Email</label> <!-- Label untuk input email -->
            <input type="email" name="email" class="form-control" value="{{ $user->email }}" required> <!-- Input untuk email pengguna, dengan nilai awal dari objek pengguna -->
        </div>
        <br>
        
        <div class="form-group"> <!-- Kontainer untuk elemen form -->
            <label for="password">Password (isi jika ingin mengganti)</label> <!-- Label untuk input password -->
            <input type="password" name="password" class="form-control"> <!-- Input untuk password, tidak wajib diisi -->
        </div>
        <br>
        
        <div class="form-group"> <!-- Kontainer untuk elemen form -->
            <label for="role">Role</label> <!-- Label untuk dropdown role -->
            <select name="role" class="form-control" required> <!-- Dropdown untuk memilih role pengguna -->
                <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option> <!-- Opsi untuk Admin, terpilih jika role pengguna adalah admin -->
                <option value="kasir" {{ $user->role == 'kasir' ? 'selected' : '' }}>Kasir</option> <!-- Opsi untuk Kasir, terpilih jika role pengguna adalah kasir -->
            </select>
        </div>
        <br>
        
        <button type="submit" class="btn btn-success">Update</button> <!-- Tombol untuk mengirim form dan memperbarui data akun -->
    </form>
</div>
@endsection
