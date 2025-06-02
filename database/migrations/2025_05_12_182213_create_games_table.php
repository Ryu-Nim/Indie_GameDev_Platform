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
            $table->string('tagline', 150)->nullable();
            $table->string('trailer')->nullable();
            $table->string('category', 20)->index();
            $table->string('type', 20)->index();
            $table->string('status', 20)->index();
            $table->tinyInteger('price_type')->default(1);
            $table->unsignedInteger('price')->nullable();
            $table->string('game_download')->nullable();
            $table->string('web_game')->nullable();
            $table->text('description')->nullable();
            $table->string('cover_image')->nullable();
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
