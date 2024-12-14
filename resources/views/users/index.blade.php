@extends('templates.app') <!-- Mengextends template layout utama -->

@section('content-dinamis') <!-- Bagian untuk konten dinamis -->
<div class="container">
    <h1>Kelola Akun</h1> <!-- Judul halaman -->

    @if (Session::get('success')) <!-- Memeriksa apakah ada pesan sukses di session -->
    <div class="alert alert-success">
        {{ Session::get('success') }} <!-- Menampilkan pesan sukses -->
    </div>
    @endif

    {{-- Wrapper untuk form cari dan tombol tambah akun --}}
    <div class="d-flex justify-content-end mb-3"> <!-- Kontainer flex untuk form pencarian dan tombol tambah -->
        {{-- Form cari --}}
        <form method="GET" action="{{ route('kelola_akun.data') }}" class="d-flex"> <!-- Form pencarian -->
            <input type="text" name="search" placeholder="Cari nama akun..." value="{{ request('search') }}" class="form-control"> <!-- Input untuk kata kunci pencarian -->
            <button type="submit" class="btn btn-primary ms-2">Search</button> <!-- Tombol pencarian -->
        </form>

        {{-- Tombol tambah akun --}}
        <a href="{{ route('kelola_akun.tambah') }}" class="btn btn-primary ms-2">Tambah Akun</a> <!-- Tombol untuk menambah akun baru -->
    </div>

    {{-- Tabel Pengguna --}}
    <table class="table"> <!-- Tabel untuk menampilkan pengguna -->
        <thead>
            <tr>
                <th>Name</th> <!-- Kolom untuk nama pengguna -->
                <th>Email</th> <!-- Kolom untuk email pengguna -->
                <th>Role</th> <!-- Kolom untuk peran pengguna -->
                <th>Action</th> <!-- Kolom untuk tindakan -->
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user) <!-- Melakukan iterasi untuk setiap pengguna -->
            <tr>
                <td>{{ $user->name }}</td> <!-- Menampilkan nama pengguna -->
                <td>{{ $user->email }}</td> <!-- Menampilkan email pengguna -->
                <td>{{ ucfirst($user->role) }}</td> <!-- Menampilkan peran pengguna dengan huruf pertama kapital -->
                <td>
                    <a href="{{ route('kelola_akun.ubah', $user->id) }}" class="btn btn-warning">Edit</a> <!-- Tombol untuk mengedit -->
                    <button class="btn btn-danger"
                    onclick="showModalDelete('{{ $user->id }}','{{ $user->name }}')">Hapus</button> <!-- Tombol untuk menghapus dengan pemicu modal -->
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"> <!-- Modal untuk konfirmasi penghapusan -->
        <div class="modal-dialog">
            <form class="modal-content" method="POST" action=""> <!-- Form untuk tindakan penghapusan -->
                @csrf <!-- Token CSRF untuk keamanan -->
                @method('DELETE') <!-- Metode spoofing untuk DELETE -->
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">HAPUS DATA AKUN</h1> <!-- Judul modal -->
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> <!-- Tombol untuk menutup modal -->
                </div>
                <div class="modal-body">
                    apakah anda yakin ingin menghapus Data akun <b id="nama_akun"></b> <!-- Pesan konfirmasi untuk penghapusan -->
                </div> 
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button> <!-- Tombol batal -->
                    <button type="submit" class="btn btn-danger">Hapus</button> <!-- Tombol untuk menghapus -->
                </div>
            </form>
        </div>
    </div>
    



</div>
@endsection
@push('script')
    
<script src="https://code.jquery.com/jquery-3.7.1.min.js"
integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script>
function showModalDelete(id, name) {
    $('#nama_akun').text(name); // Menampilkan nama akun yang akan dihapus di modal
    $('#exampleModal').modal('show'); // Menampilkan modal
    let url = "{{ route('kelola_akun.hapus' , ':id')}}"; // Menyiapkan URL untuk penghapusan
    url = url.replace(':id', id); // Mengganti :id dengan ID pengguna
    $("form").attr('action', url); // Mengatur atribut action form ke URL penghapusan
    $("exampleModal").modal('show'); // Menampilkan modal
}

</script>
@endpush
