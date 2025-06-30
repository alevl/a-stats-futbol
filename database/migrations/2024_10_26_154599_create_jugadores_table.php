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
        Schema::create('jugadores', function (Blueprint $table) {
            $table->bigIncrements('id')->unsigned();
            $table->String('nombre', 75)->nullable();
            $table->integer('numero')->nullable();
            $table->integer('dni')->nullable();
            $table->bigInteger('equipo_id')->unsigned()->nullable();
            $table->string('foto', 2048)->nullable();
            $table->string('nacimiento', 50)->nullable();
            $table->string('batea', 12)->nullable();
            $table->string('lanza', 12)->nullable();
            $table->timestamps();
            $table->foreign('equipo_id')->references('id')->on('equipos')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jugadores');
    }
};
