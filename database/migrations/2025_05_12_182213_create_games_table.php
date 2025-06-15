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
        Schema::create('games', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title', 100);
            $table->string('sinopsis', 80)->nullable();
            $table->string('pv_video_link')->nullable();
            $table->string('category_game', 25)->index();
            $table->string('type_game', 20)->index();
            $table->tinyInteger('release_status')->index()->default(1);
            $table->string('genre', 50)->index();
            $table->tinyInteger('price_type')->default(1);
            $table->unsignedInteger('price')->nullable();
            $table->string('game_download')->nullable();
            $table->string('web_game_file')->nullable();
            $table->text('description')->nullable();
            $table->string('cover_image')->nullable();
            $table->enum('status', ['tidak_aktif', 'ditinjau', 'aktif', 'ditolak', 'banned'])->default('ditinjau');
            $table->unsignedBigInteger('user_id');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('games');
    }
};
