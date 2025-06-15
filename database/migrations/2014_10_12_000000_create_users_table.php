<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('email')->unique();
            $table->string('username');
            $table->string('password'); // Pastikan di-hash saat menyimpan
            $table->tinyInteger('role')->default(1); // 1 = User, 2 = Developer
            $table->tinyInteger('status')->default(1); // 1 = Aktif, 2 = Nonaktif
            $table->string('photo')->nullable(); // Foto profil opsional
            $table->integer('coin')->default(0); // Koin untuk topup 
            $table->integer('redcoin')->default(0); // Redcoin untuk developer 
            $table->rememberToken(); // Mendukung "Remember Me" saat login
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('users');
    }
};