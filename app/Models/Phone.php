<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Phone extends Model
{
    use HasFactory;
    // jika nama model & migration ga sinkron perlu ditambah :
    // public $table = 'medicines';
    // column yg boleh diisi sama pengguna/isi datanya bukan otomatis dr sistem
    protected $fillable = ['name', 'type', 'price', 'stock'];
}
