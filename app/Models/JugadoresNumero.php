<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JugadoresNumero extends Model
{
    /** @use HasFactory<\Database\Factories\JugadoresNumeroFactory> */
    use HasFactory;

    protected $fillable = [
        'fecha',
        'jugador_id',
        'oponente_id',
        'liga_id',
        'campeonato_id',
        'categoria_id',
        'juegos',
        'vb',
        'anotadas',
        'hit',
        'dobles',
        'triples',
        'hr',
        'rbi',
        'boletos_recibidos',
        'ponches',
        'robadas',
        'out_robando',
        'alcanzadas',
        'average',
        'slugging',
        'j',
        'ganados',
        'perdidos',
        'efectividad',
        'blanqueos',
        'salvados',
        'ip',
        'carreras_permitidas',
        'carreras_limpias',
        'ponches_propinados',
        'boletos_otorgados',
        'hp',
        'pitcheos',
        'recopilador_id',
        'juego_id',
        'apariciones',
        'sacrificios',
        'golpeados',
        'vo',
        'iniciados',
        'relevos',
        'completos',
        'veces_bate',
        'h2',
        'h3',
        'h4',
        'gp',
        'wp',
        'bk',
        'orden_bat',
        'orden_pit',
        'posicion',
        'observacion',
        'fecha_invertida',
    ];

    public function numeros_campeonato()
    {
        return $this->belongsTo(Campeonato::class, 'campeonato_id');
    }
}
