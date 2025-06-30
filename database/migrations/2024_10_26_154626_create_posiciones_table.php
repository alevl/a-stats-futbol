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
        Schema::create('posiciones', function (Blueprint $table) {
            $table->engine='InnoDB';
            $table->bigIncrements('id');
            $table->bigInteger('categoria_id')->unsigned()->nullable();
            $table->bigInteger('campeonato_id')->unsigned()->nullable();
            $table->bigInteger('grupo_id')->unsigned()->nullable();
            $table->bigInteger('equipo_id')->unsigned()->nullable();
            $table->Integer('jugados')->nullable();
            $table->Integer('ganados')->nullable();
            $table->Integer('perdidos')->nullable();
            $table->Integer('empatados')->nullable();
            $table->double('porcentaje', 10,2)->nullable();
            $table->timestamps();
            $table->foreign('categoria_id')->references('id')->on('categorias')->onDelete('cascade');
            $table->foreign('campeonato_id')->references('id')->on('campeonatos')->onDelete('cascade');
            $table->foreign('grupo_id')->references('id')->on('grupos')->onDelete('cascade');
            $table->foreign('equipo_id')->references('id')->on('equipos')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posiciones');
    }
};
