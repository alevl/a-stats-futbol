<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JugadoresDefensiva extends Model
{
    /** @use HasFactory<\Database\Factories\JugadoresDefensivaFactory> */
    use HasFactory;

    protected $fillable = [
        'fecha',
        'jugador_id',
        'oponente_id',
        'liga_id',
        'campeonato_id',
        'categoria_id',
        'juegos',
        'posicion',
        'innings',
        'outs',
        'asistencias',
        'errores',
        'porcentaje_fildeo',
        'recopilador_id',
        'juego_id',
        'observacion',
        'fecha_invertida',
    ];
}
