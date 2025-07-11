<?php

namespace App\Livewire\Home;

use Livewire\Component;
use App\Models\Jugadore;
use App\Models\JugadoresNumero;
use DB;

class JugadoresNumeritos extends Component
{
    public $id_jugador, $jugador;

    public function mount($id_jugador)
    {
        $this->id_jugador = $id_jugador;
    }

    public function render()
    {
        $this->jugador = Jugadore::where('id', $this->id_jugador)->first();
        
        $numeros_temporadas = DB::table('jugadores_numeros')
        ->select('jugadores_numeros.*','campeonatos.nombre as campeonato', 'categorias.categoria as categoria'
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
        ->join('categorias', 'categorias.id', '=', 'jugadores_numeros.categoria_id')
        ->where('jugadores_numeros.jugador_id', $this->id_jugador)
        ->groupBy('jugadores_numeros.campeonato_id')
        ->get();


        $juegos_totales = DB::table('jugadores_numeros')
        ->select('jugadores_numeros.*','campeonatos.nombre as campeonato','equipos.nombre as oponente', 'categorias.categoria as categoria'
        , 'jugadores_numeros.juegos as juegos'
        , 'jugadores_numeros.goles as goles'
        , 'jugadores_numeros.asistencias as asistencias'
        , 'jugadores_numeros.tiros_arco as tiros_arco'
        , 'jugadores_numeros.faltas_cometidas as faltas_cometidas'
        , 'jugadores_numeros.faltas_recibidas as faltas_recibidas'
        , 'jugadores_numeros.tarjetas_amarilla as tarjetas_amarilla'
        , 'jugadores_numeros.tarjetas_roja as tarjetas_roja'
        , 'jugadores_numeros.atajadas as atajadas'
        , 'jugadores_numeros.penales_cobrados as penales_cobrados'
        , 'jugadores_numeros.penales_fallados as penales_fallados'
        , 'jugadores_numeros.fuera_juego as fuera_juego')
        ->join('campeonatos', 'campeonatos.id', '=', 'jugadores_numeros.campeonato_id')
        ->join('equipos', 'equipos.id', '=', 'jugadores_numeros.oponente_id')
        ->join('categorias', 'categorias.id', '=', 'jugadores_numeros.categoria_id')
        ->where('jugadores_numeros.jugador_id', $this->id_jugador)
        ->orderBy('fecha_invertida','asc')
        ->get();

        return view('livewire.home.jugadores-numeritos')->with('numeros_temporadas', $numeros_temporadas)->with('juegos_totales', $juegos_totales);
    }
}