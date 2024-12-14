<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'phones', 'name_customer', 'total_price'];

    // casts : memastikan tipe data migration
    protected $casts = [
        'phones' => 'array'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
