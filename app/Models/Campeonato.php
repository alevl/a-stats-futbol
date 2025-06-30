<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Campeonato extends Model
{
    /** @use HasFactory<\Database\Factories\CampeonatoFactory> */
    use HasFactory;

    protected $fillable = [
        'nombre',
        'liga_id',
        'categoria_id',
        'fecha_inicio',
        'campeon_id',
        'estatus_id',
    ];

    public function torneo_liga()
    {
        return $this->belongsTo(Liga::class, 'liga_id');
    }
    public function torneo_estatus()
    {
        return $this->belongsTo(EstatusTorneo::class, 'estatus_id');
    }
    public function torneo_categoria()
    {
        return $this->belongsTo(Categoria::class, 'categoria_id');
    }
    public function torneo_campeon()
    {
        return $this->belongsTo(Equipo::class, 'campeon_id');
    }

}
