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
        Schema::create('jugadores_defensivas', function (Blueprint $table) {
            $table->bigIncrements('id')->unsigned();
            $table->bigInteger('juego_id')->unsigned()->nullable();
            $table->string('fecha', 20)->nullable();
            $table->bigInteger('jugador_id')->unsigned()->nullable();
            $table->bigInteger('oponente_id')->unsigned()->nullable();
            $table->bigInteger('liga_id')->unsigned()->nullable();
            $table->bigInteger('campeonato_id')->unsigned()->nullable();
            $table->bigInteger('categoria_id')->unsigned()->nullable();
            //DEFENSIVA
            $table->Integer('juegos')->nullable()->default('0');
            $table->Integer('posicion')->nullable()->default('0');
            $table->double('innings', 10,2)->nullable()->default('0');
            $table->Integer('outs')->nullable()->default('0');
            $table->Integer('asistencias')->nullable()->default('0');
            $table->Integer('errores')->nullable()->default('0');
            $table->double('porcentaje_fildeo', 10,2)->nullable()->default('0');
            $table->string('observacion', 20)->nullable();
            $table->Integer('fecha_invertida')->nullable();
            $table->bigInteger('recopilador_id')->unsigned()->nullable();

            $table->timestamps();
            $table->foreign('juego_id')->references('id')->on('calendarios')->onDelete('cascade');
            $table->foreign('jugador_id')->references('id')->on('jugadores')->onDelete('cascade');
            $table->foreign('oponente_id')->references('id')->on('equipos')->onDelete('cascade');
            $table->foreign('liga_id')->references('id')->on('ligas')->onDelete('cascade');
            $table->foreign('campeonato_id')->references('id')->on('campeonatos')->onDelete('cascade');
            $table->foreign('categoria_id')->references('id')->on('categorias')->onDelete('cascade');
            $table->foreign('recopilador_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jugadores_defensivas');
    }
};
