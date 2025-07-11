<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JugadoresNumero extends Model
{
    /** @use HasFactory<\Database\Factories\JugadoresNumeroFactory> */
    use HasFactory;

    protected $fillable = [
        'juego_id',
        'fecha',
        'jugador_id',
        'oponente_id',
        'liga_id',
        'campeonato_id',
        'categoria_id',
        'orden_bat',
        'posicion',
        'juegos',
        'goles',
        'asistencias',
        'tiros_arco',
        'faltas_cometidas',
        'faltas_recibidas',
        'tarjetas_amarilla',
        'tarjetas_roja',            
        'atajadas',
        'penales_cobrados',
        'penales_fallados',
        'fuera_juego',
        'observacion',
        'fecha_invertida',
        'recopilador_id',
    ];

    public function numeros_campeonato()
    {
        return $this->belongsTo(Campeonato::class, 'campeonato_id');
    }
}
