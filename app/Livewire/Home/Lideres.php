<?php

namespace App\Livewire\Home;

use Livewire\Component;
use App\Models\Jugadore;
use App\Models\JugadoresNumero;
use App\Models\Campeonato;
use DB;

class Lideres extends Component
{
    public $id_jugador, $torneo=0, $categoria=0, $torneos=[], $categorias=[];

    public $sort = 'goles';
    public $direccion = 'desc';
    public $sort2 = 'posicion';
    public $direc = 'asc';


    public function updatedCategoria($value)
    {
        $this->torneo = null;
    }

    public function render()
    {
        $this->categorias = Campeonato::orderBy('categoria_id','asc')
        ->select('categorias.*','campeonatos.*','categorias.id as id')
        ->join('categorias', 'categorias.id', '=', 'campeonatos.categoria_id')
        ->get();

        $this->torneos = Campeonato::where('categoria_id', $this->categoria)->orderBy('fecha_inicio', 'desc')->get();

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
        ->where('jugadores_numeros.categoria_id', $this->categoria)
        ->where('jugadores_numeros.campeonato_id', $this->torneo)
        ->groupBy('jugador_id')
        ->orderBy($this->sort, $this->direccion)
        ->get();

        return view('livewire.home.lideres')->with('numeros_temporadas', $numeros_temporadas);
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
