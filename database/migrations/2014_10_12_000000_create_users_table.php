<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('email')->unique();
            $table->string('username');
            $table->string('password');
            $table->tinyInteger('role')->default(1); // 1 = User, 2 = Developer
            $table->tinyInteger('status')->default(1); // 1 = Aktif, 2 = Nonaktif
            $table->string('photo')->nullable(); // Foto profil opsional
            $table->timestamps(); // created_at & updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
