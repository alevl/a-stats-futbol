<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Calendario extends Model
{
    /** @use HasFactory<\Database\Factories\CalendarioFactory> */
    use HasFactory;

    protected $fillable = [
        'numero_juego',
        'fecha_juego',
        'hora_juego',
        'estadio_id',
        'categoria_id',
        'campeonato_id',
        'grupo_id',
        'visita_id',
        'casa_id',
        'anotacion_visita',
        'anotacion_casa',
        'hits_visita',
        'hits_casa',
        'errores_visita',
        'errores_casa',
        'anotador_id',
        'arbitro1_id',
        'arbitro2_id',
        'arbitro3_id',
        'arbitro4_id',
        'observacion',
        'tiempo',
        'bat_destacado',
        'pit_destacado',
        'texto_bateador',
        'texto_pitcher',
        'condicion',
        'fecha_invertida',
    ];

    public function calendario_estadio()
    {
        return $this->belongsTo(Estadio::class, 'estadio_id');
    }
    public function calendario_grupo()
    {
        return $this->belongsTo(Grupo::class, 'grupo_id');
    }
    public function calendario_visita()
    {
        return $this->belongsTo(Equipo::class, 'visita_id');
    }
    public function calendario_casa()
    {
        return $this->belongsTo(Equipo::class, 'casa_id');
    }
    public function calendario_bateador()
    {
        return $this->belongsTo(Jugadore::class, 'bat_destacado_id');
    }
    public function calendario_pitcher()
    {
        return $this->belongsTo(Jugadore::class, 'pit_destacado_id');
    }
    public function calendario_anotador()
    {
        return $this->belongsTo(Anotadore::class, 'anotador_id');
    }
    public function calendario_arbitro1()
    {
        return $this->belongsTo(Arbitro::class, 'arbitro1_id');
    }
    public function calendario_arbitro2()
    {
        return $this->belongsTo(Arbitro::class, 'arbitro2_id');
    }
    public function calendario_arbitro3()
    {
        return $this->belongsTo(Arbitro::class, 'arbitro3_id');
    }
    public function calendario_arbitro4()
    {
        return $this->belongsTo(Arbitro::class, 'arbitro4_id');
    }
    public function calendario_categoria()
    {
        return $this->belongsTo(Categoria::class, 'categoria_id');
    }
    public function calendario_torneo()
    {
        return $this->belongsTo(Campeonato::class, 'campeonato_id');
    }
    public function calendario_facturado()
    {
        return $this->belongsTo(Condicione::class, 'facturado_id');
    }
}
