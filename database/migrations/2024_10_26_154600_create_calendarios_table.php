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
        Schema::create('calendarios', function (Blueprint $table) {
            $table->engine='InnoDB';
            $table->bigIncrements('id');
            $table->string('fecha_juego', 30)->nullable();
            $table->string('hora_juego', 20)->nullable();
            $table->integer('numero_juego')->nullable();
            $table->bigInteger('estadio_id')->unsigned()->nullable();
            $table->bigInteger('categoria_id')->unsigned()->nullable();
            $table->bigInteger('campeonato_id')->unsigned()->nullable();
            $table->bigInteger('grupo_id')->unsigned()->nullable();
            $table->bigInteger('visita_id')->unsigned()->nullable();
            $table->bigInteger('casa_id')->unsigned()->nullable();
            $table->Integer('anotacion_visita')->nullable();
            $table->Integer('anotacion_casa')->nullable();
            $table->Integer('hits_visita')->nullable();
            $table->Integer('hits_casa')->nullable();
            $table->Integer('errores_visita')->nullable();
            $table->Integer('errores_casa')->nullable();
            $table->bigInteger('anotador_id')->unsigned()->nullable();
            $table->bigInteger('arbitro1_id')->unsigned()->nullable();
            $table->bigInteger('arbitro2_id')->unsigned()->nullable();
            $table->bigInteger('arbitro3_id')->unsigned()->nullable();
            $table->bigInteger('arbitro4_id')->unsigned()->nullable();
            $table->string('observacion', 255)->nullable();
            $table->string('tiempo', 30)->nullable();
            $table->bigInteger('bat_destacado_id')->unsigned()->nullable();
            $table->bigInteger('pit_destacado_id')->unsigned()->nullable();
            $table->string('texto_bateador', 21)->nullable();
            $table->string('texto_pitcher', 21)->nullable();
            $table->string('condicion', 10)->nullable()->default('Normal');
            $table->bigInteger('facturado_id')->unsigned()->nullable()->default(2);
            $table->Integer('fecha_invertida')->nullable();

            $table->timestamps();
            $table->foreign('visita_id')->references('id')->on('equipos')->onDelete('cascade');
            $table->foreign('casa_id')->references('id')->on('equipos')->onDelete('cascade');
            $table->foreign('categoria_id')->references('id')->on('categorias')->onDelete('cascade');
            $table->foreign('campeonato_id')->references('id')->on('campeonatos')->onDelete('cascade');
            $table->foreign('grupo_id')->references('id')->on('grupos')->onDelete('cascade');
            $table->foreign('anotador_id')->references('id')->on('anotadores')->onDelete('cascade');
            $table->foreign('arbitro1_id')->references('id')->on('arbitros')->onDelete('cascade');
            $table->foreign('arbitro2_id')->references('id')->on('arbitros')->onDelete('cascade');
            $table->foreign('arbitro3_id')->references('id')->on('arbitros')->onDelete('cascade');
            $table->foreign('arbitro4_id')->references('id')->on('arbitros')->onDelete('cascade');
            $table->foreign('estadio_id')->references('id')->on('estadios')->onDelete('cascade');
            $table->foreign('bat_destacado_id')->references('id')->on('jugadores')->onDelete('cascade');
            $table->foreign('pit_destacado_id')->references('id')->on('jugadores')->onDelete('cascade');
            $table->foreign('facturado_id')->references('id')->on('condiciones')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('calendarios');
    }
};
