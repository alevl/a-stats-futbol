<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Posicione extends Model
{
    /** @use HasFactory<\Database\Factories\PosicioneFactory> */
    use HasFactory;

    protected $fillable = [
        'categoria_id',
        'campeonato_id',
        'grupo_id',
        'equipo_id',
        'jugados',
        'ganados',
        'perdidos',
        'empatados',
        'porcentaje',
    ];


    public function posicion_equipo()
    {
        return $this->belongsTo(Equipo::class, 'equipo_id');
    }
}
