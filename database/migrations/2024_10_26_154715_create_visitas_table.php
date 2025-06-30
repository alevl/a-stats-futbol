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
        Schema::create('visitas', function (Blueprint $table) {
            $table->engine='InnoDB';
            $table->bigIncrements('id');
            $table->string('ip', 15)->nullable();
            $table->bigInteger('campeonato_id')->unsigned()->nullable();
            $table->string('pais', 75)->nullable();
            $table->string('estado', 75)->nullable();
            $table->string('ciudad', 75)->nullable();
            $table->timestamps();

            $table->foreign('campeonato_id')->references('id')->on('campeonatos')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('visitas');
    }
};
