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
        Schema::create('jugadores_numeros', function (Blueprint $table) {
            $table->bigIncrements('id')->unsigned();
            $table->bigInteger('juego_id')->unsigned()->nullable();
            $table->string('fecha', 20)->nullable();
            $table->bigInteger('jugador_id')->unsigned()->nullable();
            $table->bigInteger('oponente_id')->unsigned()->nullable();
            $table->bigInteger('liga_id')->unsigned()->nullable();
            $table->bigInteger('campeonato_id')->unsigned()->nullable();
            $table->bigInteger('categoria_id')->unsigned()->nullable();
            //BATEADORES
            $table->double('orden_bat', 10,2)->nullable()->default('99');
            $table->string('posicion', 15)->nullable();
            $table->Integer('juegos')->nullable()->default('0');
            $table->Integer('vb')->nullable()->default('0');
            $table->Integer('anotadas')->nullable()->default('0');
            $table->Integer('hit')->nullable()->default('0');
            $table->Integer('dobles')->nullable()->default('0');
            $table->Integer('triples')->nullable()->default('0');
            $table->Integer('hr')->nullable()->default('0');
            $table->Integer('rbi')->nullable()->default('0');
            $table->Integer('boletos_recibidos')->nullable()->default('0');
            $table->Integer('ponches')->nullable()->default('0');
            $table->Integer('robadas')->nullable()->default('0');
            $table->Integer('out_robando')->nullable()->default('0');
            $table->Integer('alcanzadas')->nullable()->default('0');
            $table->Integer('average')->nullable()->default('0');
            $table->Integer('slugging')->nullable()->default('0');
            $table->Integer('apariciones')->nullable()->default('0');
            $table->Integer('sacrificios')->nullable()->default('0');
            $table->Integer('golpeados')->nullable()->default('0');
            $table->Integer('vo')->nullable()->default('0');
            //PICHERS
            $table->double('orden_pit', 10,2)->nullable();
            $table->Integer('j')->nullable()->default('0');
            $table->Integer('ganados')->nullable()->default('0');
            $table->Integer('perdidos')->nullable()->default('0');
            $table->Integer('salvados')->nullable()->default('0');
            $table->double('efectividad', 10,2)->nullable()->default('0');
            $table->Integer('blanqueos')->nullable()->default('0');
            $table->double('ip', 10,2)->nullable()->default('0');
            $table->Integer('carreras_permitidas')->nullable()->default('0');
            $table->Integer('carreras_limpias')->nullable()->default('0');
            $table->Integer('ponches_propinados')->nullable()->default('0');
            $table->Integer('boletos_otorgados')->nullable()->default('0');
            $table->Integer('hp')->nullable()->default('0');
            $table->Integer('pitcheos')->nullable()->default('0');
            $table->Integer('iniciados')->nullable()->default('0');
            $table->Integer('relevos')->nullable()->default('0');
            $table->Integer('completos')->nullable()->default('0');
            $table->Integer('veces_bate')->nullable()->default('0');
            $table->Integer('h2')->nullable()->default('0');
            $table->Integer('h3')->nullable()->default('0');
            $table->Integer('h4')->nullable()->default('0');
            $table->Integer('gp')->nullable()->default('0');
            $table->Integer('wp')->nullable()->default('0');
            $table->Integer('bk')->nullable()->default('0');
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
        Schema::dropIfExists('jugadores_numeros');
    }
};
