<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Equipo extends Model
{
    /** @use HasFactory<\Database\Factories\EquipoFactory> */
    use HasFactory;

    protected $fillable = [
        'nombre',
        'abreviacion',
        'deporte_id',
        'liga_id',
        'categoria_id',
        'logo',
        'campeonato_id',
    ];

    public function equipo_liga()
    {
        return $this->belongsTo(Liga::class, 'liga_id');
    }
    public function equipo_deporte()
    {
        return $this->belongsTo(Deporte::class, 'deporte_id');
    }
    public function equipo_categoria()
    {
        return $this->belongsTo(Categoria::class, 'categoria_id');
    }
    public function equipo_torneo()
    {
        return $this->belongsTo(Campeonato::class, 'campeonato_id');
    }

}
