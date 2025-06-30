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
        Schema::create('equipos', function (Blueprint $table) {
            $table->engine='InnoDB';
            $table->bigIncrements('id');
            $table->string('nombre', 100)->nullable();
            $table->string('abreviacion', 100)->nullable();
            $table->bigInteger('deporte_id')->unsigned()->nullable();
            $table->bigInteger('campeonato_id')->unsigned()->nullable();
            $table->bigInteger('liga_id')->unsigned()->nullable();
            $table->bigInteger('categoria_id')->unsigned()->nullable();
            $table->string('logo', 2048)->nullable();
            $table->timestamps();

            $table->foreign('deporte_id')->references('id')->on('ligas')->onDelete('cascade');
            $table->foreign('campeonato_id')->references('id')->on('campeonatos')->onDelete('cascade');
            $table->foreign('liga_id')->references('id')->on('ligas')->onDelete('cascade');
            $table->foreign('categoria_id')->references('id')->on('categorias')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('equipos');
    }
};
