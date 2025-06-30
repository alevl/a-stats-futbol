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
        Schema::create('campeonatos', function (Blueprint $table) {
            $table->engine='InnoDB';
            $table->bigIncrements('id');
            $table->string('nombre', 100)->nullable();
            $table->bigInteger('liga_id')->unsigned()->nullable();
            $table->bigInteger('categoria_id')->unsigned()->nullable();
            $table->string('fecha_inicio', 20)->nullable();
            $table->string('campeon', 100)->nullable();
            $table->bigInteger('estatus_id')->unsigned()->nullable();

            $table->timestamps();

            $table->foreign('estatus_id')->references('id')->on('estatus_torneos')->onDelete('cascade');
            $table->foreign('liga_id')->references('id')->on('ligas')->onDelete('cascade');
            $table->foreign('categoria_id')->references('id')->on('categorias')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('campeonatos');
    }
};
