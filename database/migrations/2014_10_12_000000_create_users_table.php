<?php

use Illuminate\Database\Migrations\Migration; // Mengimpor kelas Migration
use Illuminate\Database\Schema\Blueprint; // Mengimpor kelas Blueprint untuk mendefinisikan tabel
use Illuminate\Support\Facades\Schema; // Mengimpor facade Schema untuk operasi database

return new class extends Migration // Mendefinisikan kelas migrasi menggunakan pendekatan anonymous class
{
    /**
     * Menjalankan migrasi.
     */
    public function up(): void
    {
        // Membuat tabel 'users'
        Schema::create('users', function (Blueprint $table) {
            $table->id(); // Menambahkan kolom id dengan tipe auto-increment
            $table->string('name'); // Menambahkan kolom 'name' dengan tipe string
            $table->string('email')->unique(); // Menambahkan kolom 'email' dengan tipe string dan harus unik
            $table->timestamp('email_verified_at')->nullable(); // Menambahkan kolom 'email_verified_at' dengan tipe timestamp yang bisa bernilai null
            $table->string('password'); // Menambahkan kolom 'password' dengan tipe string
            $table->rememberToken(); // Menambahkan kolom untuk token "remember me" pada otentikasi
            $table->timestamps(); // Menambahkan kolom 'created_at' dan 'updated_at'
        });
    }

    /**
     * Mengembalikan migrasi.
     */
    public function down(): void
    {
        // Menghapus tabel 'users' jika migrasi dibatalkan
        Schema::dropIfExists('users');
    }
};
