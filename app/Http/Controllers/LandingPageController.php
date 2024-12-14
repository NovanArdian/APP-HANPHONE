<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LandingPageController extends Controller
{
    // menampilkan halaman awal/menampilkan halaman yg banyak datanya (tables)
    public function index()
    {
        // return view : menghubungkan controller dengan file view yg ada di resources/views atau menampilkan layout view yg ada di file tersebut
        // pemanggilannya : nama-folder.nama_file
        return view('landing_page');
    }

    // menampilkan halaman form tambah data
    public function create()
    {
        //
    }

    // proses pengiriman data baru ke database
    public function store(Request $request)
    {
        //
    }

    // menampilkan 1 data spesifik
    public function show(string $id)
    {
        //
    }

    // menampilkan form ubah data
    public function edit(string $id)
    {
        //
    }

    // memproses ubah data di databasenya
    public function update(Request $request, string $id)
    {
        //
    }

    // menghapus data di databasenya
    public function destroy(string $id)
    {
        //
    }
}
