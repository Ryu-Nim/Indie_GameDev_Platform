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
        Schema::create('admins', function (Blueprint $table) {
            $table->id(); // ID unik admin
            $table->string('email')->unique(); // Email unik admin
            $table->string('username')->unique(); // Username unik admin
            $table->string('password'); // Password admin
            $table->tinyInteger('role')->default(2); // 1 = Super Admin, 2 = Admin Biasa
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('admins');
    }
};
