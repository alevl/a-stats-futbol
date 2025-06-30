<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jugadore extends Model
{
    /** @use HasFactory<\Database\Factories\JugadoreFactory> */
    use HasFactory;

    protected $fillable = [
        'nombre',
        'dni',
        'equipo_id',
        'foto',
        'numero',
        'nacimiento',
        'batea',
        'lanza',
    ];

    public function jugador_liga()
    {
        return $this->belongsTo(Liga::class, 'liga_id');
    }
    public function jugador_equipo()
    {
        return $this->belongsTo(Equipo::class, 'equipo_id');
    }
    public function jugador_categoria()
    {
        return $this->belongsTo(Categoria::class, 'categoria_id');
    }
    public function jugador_campeonato()
    {
        return $this->belongsTo(Campeonato::class, 'campeonato_id');
    }

}
