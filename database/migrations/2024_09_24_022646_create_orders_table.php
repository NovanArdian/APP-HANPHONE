<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            // FK : kalau relasinya di atur model, tipedata FK nya jadikan bigInteger
            $table->bigInteger('user_id');
            // kalau relasinya pake migration :
            // $table->foreignId('user_id')->constrained('users');
            // tidak suport array : diganti jadi json
            $table->json('phones');
            $table->integer('total_price');
            $table->string('name_customer');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
