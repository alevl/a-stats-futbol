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
        Schema::create('categorias', function (Blueprint $table) {
            $table->engine='InnoDB';
            $table->bigIncrements('id');
            $table->string('categoria', 30)->nullable();
            $table->bigInteger('liga_id')->unsigned()->nullable();
            $table->bigInteger('deporte_id')->unsigned()->nullable();
            $table->timestamps();

            $table->foreign('liga_id')->references('id')->on('ligas')->onDelete('cascade');
            $table->foreign('deporte_id')->references('id')->on('deportes')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categorias');
    }
};
