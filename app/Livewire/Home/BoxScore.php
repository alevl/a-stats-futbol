<?php

namespace App\Livewire\Home;

use Livewire\Component;
use App\Models\Jugadore;
use App\Models\Calendario;
use App\Models\JugadoresNumero;
use App\Models\JugadoresDefensiva;
use App\Models\Campeonato;
use App\Models\Equipo;
use DB;

class BoxScore extends Component
{
    public $tipo="bateador";
    public $id_juego, $datos_juego;

    public $readyToLoad = false;

    protected $listeners = ['render', 'delete'];

    public function mount($id_juego)
    {
        $this->id_juego = $id_juego;

        $this->datos_juego = DB::table('calendarios')
        ->select('calendarios.*','categorias.*','campeonatos.*', 'equipos.nombre as nombre_visita', 'home.nombre as nombre_casa')
        ->join('categorias', 'categorias.id', '=', 'calendarios.categoria_id')
        ->join('campeonatos', 'campeonatos.id', '=', 'calendarios.campeonato_id')
        ->join('equipos', 'equipos.id', '=', 'calendarios.visita_id')
        ->join('equipos as home', 'home.id', '=', 'calendarios.casa_id')
        ->where('calendarios.id', $this->id_juego)
        ->first();
    }

    public function render()
    {
        $bateo_visita = JugadoresNumero::where('juego_id', $this->id_juego)
        ->select('jugadores_numeros.*','jugadores.nombre as jugador','jugadores.equipo_id as equipo','equipos.nombre as nombre_equipo')
        ->join('jugadores', 'jugadores.id', '=', 'jugadores_numeros.jugador_id')
        ->join('equipos', 'equipos.id', '=', 'jugadores.equipo_id')
        ->where('jugadores_numeros.oponente_id','<>', $this->datos_juego->visita_id)
        ->where('jugadores_numeros.juegos','>',0)
        ->orderBy('equipos.nombre', 'asc')
        ->orderBy('jugadores_numeros.orden_bat', 'asc')
        ->get();

        $bateo_casa = JugadoresNumero::where('juego_id', $this->id_juego)
        ->select('jugadores_numeros.*','jugadores.nombre as jugador','jugadores.equipo_id as equipo','equipos.nombre as nombre_equipo')
        ->join('jugadores', 'jugadores.id', '=', 'jugadores_numeros.jugador_id')
        ->join('equipos', 'equipos.id', '=', 'jugadores.equipo_id')
        ->where('jugadores_numeros.oponente_id','<>', $this->datos_juego->casa_id)
        ->where('jugadores_numeros.juegos','>',0)
        ->orderBy('equipos.nombre', 'asc')
        ->orderBy('jugadores_numeros.orden_bat', 'asc')
        ->get();

        return view('livewire.home.box-score')->with('bateo_visita', $bateo_visita)->with('bateo_casa', $bateo_casa);
    }
}
