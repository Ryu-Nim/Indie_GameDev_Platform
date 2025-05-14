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
        Schema::create('blocks', function (Blueprint $table) {
            $table->bigIncrements('id'); // ID auto-increment untuk setiap block event
            $table->unsignedBigInteger('blocker_id'); // ID user yang memblokir
            $table->unsignedBigInteger('blocked_id'); // ID user yang diblokir
            $table->timestamps();

            // Relasi ke tabel users dengan auto-increment ID
            $table->foreign('blocker_id', 'fk_blocks_blocker')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('blocked_id', 'fk_blocks_blocked')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('blocks');
    }
};
