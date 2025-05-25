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
            $table->enum('role', ['user', 'developer'])->default('user'); 
            $table->enum('status', ['active', 'inactive'])->default('active'); 
            $table->string('photo')->nullable(); 
            $table->rememberToken(); // Mendukung "Remember Me" saat login
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('users');
    }
};