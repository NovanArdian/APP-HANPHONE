<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;


class UserController extends Controller
{


   
    public function loginProses(Request $request)
{
    $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);

    $user = User::where('email', $request->email)->first();

    if ($user && Hash::check($request->password, $user->password)) {
        auth()->login($user);
        return redirect()->route('landing_page');
    } else {
        return redirect()->back()->with('failed', 'Email atau password salah');
    }
}

    public function logout()
    {
        Auth::logout();

        return redirect()->route('login')->with('logout', 'Berhasil Logout');
       
    }

    public function index(Request $request)
    {
        // Mengambil nilai input pencarian dari request
        $search = $request->input('search');
        
        // Menampilkan user dengan fitur pencarian jika input pencarian diisi
        $users = User::when($search, function ($query, $search) {
            return $query->where('name', 'like', '%' . $search . '%');
        })->get();

        // Menampilkan view 'users.index' dengan data user dan search term
        return view('users.index', compact('users', 'search'));
    }

    // Menampilkan form untuk membuat user baru
  public function create()
{
    return view('users.createee'); // Menampilkan ke halaman folder users yang namanya createee
}

// Menyimpan user baru ke dalam database
public function store(Request $request)
{
    // Validasi data input
$request->validate([
            'name' => 'required|max:100', // Nama wajib diisi, maksimal 100 karakter
            'role' => 'required', // Role wajib diisi
            'email' => 'required', // Email wajib diisi
            'password' => 'required' // Password wajib diisi
        ],[
            // Pesan error kustom untuk validasi input
            'name.required' => 'Nama Harus Diisi!',
            'role.required' => 'Role Harus Diisi!',
            'email.required' => 'Email Harus Diisi!',
            'password.required' => 'Password Harus Diisi'

        ]);

        // Menyimpan data user baru ke dalam database
        $password = bcrypt($request->password);
        User::create($request->all());

        // Redirect ke halaman kelola akun dengan pesan sukses
        return redirect()->route('kelola_akun.data')->with('success', 'Berhasil Menambah Data User!');
}
    // Menampilkan form untuk mengedit data user berdasarkan ID
    public function edit($id)
    {
        $user = User::find($id);
        return view('users.editt', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
{
    // Validasi input dari request
    $request->validate([
        'name' => 'required|max:100',
        'email' => 'required|email|unique:users,email,'.$id,
        'role' => 'required|string|max:255|in:admin,kasir',
        'password' => "required"

    ]);

     $password = bcrypt($request->password);


    // Update pengguna dengan data baru
    User::where('id', $id)->update([
        'name' => $request->name,
        'email' => $request->email,
        'role' => $request->role,
        'password' => $request->password,

    ]);

    return redirect()->route('kelola_akun.data')->with('success', 'Berhasil Mengedit Data Pengguna!');
}
    // Menghapus user berdasarkan ID dengan konfirmasi
    public function destroy($id)
    {
        User::where('id',$id)->delete();
        return redirect()->back()->with('success', 'Berhasil Menghapus Data akun!');
    }
}
