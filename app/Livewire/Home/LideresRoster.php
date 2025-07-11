<?php

namespace App\Livewire\Home;

use Livewire\Component;
use App\Models\Jugadore;
use App\Models\JugadoresNumero;
use App\Models\Campeonato;
use DB;

class LideresRoster extends Component
{
    public $id_jugador, $torneo, $categoria=1, $torneos=[], $categorias=[], $id_equipo, $id_categoria, $id_torneo;

    public $sort = 'goles';
    public $direccion = 'desc';
    public $tipo = 'bateador';

    public function mount($id_equipo, $id_categoria, $id_torneo)
    {
        $this->id_equipo = $id_equipo;
        $this->id_categoria = $id_categoria;
        $this->id_torneo = $id_torneo;
    }

    public function render()
    {
        $numeros_temporadas = DB::table('jugadores_numeros')
        ->select('jugadores_numeros.*','campeonatos.nombre as campeonato','jugadores.nombre as jugador','jugadores.equipo_id as equipo','equipos.nombre as nombre_equipo'
        , DB::raw('sum(jugadores_numeros.juegos) as juegos')
        , DB::raw('sum(jugadores_numeros.goles) as goles')
        , DB::raw('sum(jugadores_numeros.asistencias) as asistencias')
        , DB::raw('sum(jugadores_numeros.tiros_arco) as tiros_arco')
        , DB::raw('sum(jugadores_numeros.faltas_cometidas) as faltas_cometidas')
        , DB::raw('sum(jugadores_numeros.faltas_recibidas) as faltas_recibidas')
        , DB::raw('sum(jugadores_numeros.tarjetas_amarilla) as tarjetas_amarilla')
        , DB::raw('sum(jugadores_numeros.tarjetas_roja) as tarjetas_roja')
        , DB::raw('sum(jugadores_numeros.atajadas) as atajadas')
        , DB::raw('sum(jugadores_numeros.penales_cobrados) as penales_cobrados')
        , DB::raw('sum(jugadores_numeros.penales_fallados) as penales_fallados')
        , DB::raw('sum(jugadores_numeros.fuera_juego) as fuera_juego'))
        ->join('campeonatos', 'campeonatos.id', '=', 'jugadores_numeros.campeonato_id')
        ->join('jugadores', 'jugadores.id', '=', 'jugadores_numeros.jugador_id')
        ->join('equipos', 'equipos.id', '=', 'jugadores.equipo_id')
        ->where('equipos.id', $this->id_equipo)
        ->where('jugadores_numeros.categoria_id', $this->id_categoria)
        ->where('jugadores_numeros.campeonato_id', $this->id_torneo)
        ->groupBy('jugador_id')
        ->orderBy($this->sort, $this->direccion)
        ->get();

        return view('livewire.home.lideres-roster')->with('numeros_temporadas', $numeros_temporadas);
    }

    public function order($sort)
    {
        if($this->sort == $sort)
        {
            if($this->direccion == 'desc') 
            {
                $this->direccion = 'asc';
            }
            else 
            {
                $this->direccion = 'desc';
            }
        }
        else
        {
            $this->sort = $sort;
            $this->direccion = 'asc';
        }
    }
}
