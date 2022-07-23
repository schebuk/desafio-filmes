<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFilmesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('filmes', function (Blueprint $table) {
            $table->id();
            $table->string('genre_ids')->nullable();
            $table->string('original_language')->nullable();
            $table->string('original_title');
            $table->longText('overview');
            $table->string('poster_path')->nullable();
            $table->string('release_date')->nullable();
            $table->string('title');
            $table->float('popularity');
            $table->float('vote_average');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('filmes');
    }
}
