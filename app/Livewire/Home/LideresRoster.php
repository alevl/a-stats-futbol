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

    public $sort = 'porcentaje_bateo';
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
        , DB::raw('sum(jugadores_numeros.vb) as vb')
        , DB::raw('sum(jugadores_numeros.anotadas) as anotadas')
        , DB::raw('sum(jugadores_numeros.hit) as hit')
        , DB::raw('sum(jugadores_numeros.dobles) as dobles')
        , DB::raw('sum(jugadores_numeros.triples) as triples')
        , DB::raw('sum(jugadores_numeros.hr) as hr')
        , DB::raw('sum(jugadores_numeros.rbi) as rbi')
        , DB::raw('sum(jugadores_numeros.boletos_recibidos) as boletos_recibidos')
        , DB::raw('sum(jugadores_numeros.ponches) as ponches')
        , DB::raw('sum(jugadores_numeros.robadas) as robadas')
        , DB::raw('sum(jugadores_numeros.out_robando) as out_robando')
        , DB::raw('sum(jugadores_numeros.alcanzadas) as alcanzadas')
        , DB::raw('sum(jugadores_numeros.apariciones) as apariciones')
        , DB::raw('sum(jugadores_numeros.sacrificios) as sacrificios')
        , DB::raw('sum(jugadores_numeros.golpeados) as golpeados')
        , DB::raw('sum(jugadores_numeros.vo) as vo')
        , DB::raw('((sum(jugadores_numeros.hit) * 1000) / sum(jugadores_numeros.vb)) as porcentaje_bateo')
        , DB::raw('(((sum(jugadores_numeros.hit) - sum(jugadores_numeros.dobles) - sum(jugadores_numeros.triples) - sum(jugadores_numeros.hr)) + (sum(jugadores_numeros.dobles) * 2) + (sum(jugadores_numeros.triples) * 3) + (sum(jugadores_numeros.hr) * 4)) / sum(jugadores_numeros.vb)) * 1000 as porcentaje_slugging')
        , DB::raw('sum(jugadores_numeros.j) as j')
        , DB::raw('sum(jugadores_numeros.ganados) as ganados')
        , DB::raw('sum(jugadores_numeros.perdidos) as perdidos')
        , DB::raw('sum(jugadores_numeros.efectividad) as efectividad')
        , DB::raw('sum(jugadores_numeros.salvados) as salvados')
        , DB::raw('sum(jugadores_numeros.ip) as ip')
        , DB::raw('sum(jugadores_numeros.iniciados) as iniciados')
        , DB::raw('sum(jugadores_numeros.relevos) as relevos')
        , DB::raw('sum(jugadores_numeros.completos) as completos')
        , DB::raw('sum(jugadores_numeros.veces_bate) as veces_bate')
        , DB::raw('sum(jugadores_numeros.h2) as h2')
        , DB::raw('sum(jugadores_numeros.h3) as h3')
        , DB::raw('sum(jugadores_numeros.h4) as h4')
        , DB::raw('sum(jugadores_numeros.gp) as gp')
        , DB::raw('sum(jugadores_numeros.wp) as wp')
        , DB::raw('sum(jugadores_numeros.bk) as bk')
        , DB::raw('sum(jugadores_numeros.carreras_permitidas) as carreras_permitidas')
        , DB::raw('sum(jugadores_numeros.carreras_limpias) as carreras_limpias')
        , DB::raw('sum(jugadores_numeros.ponches_propinados) as ponches_propinados')
        , DB::raw('((sum(jugadores_numeros.carreras_limpias) * 9) / sum(jugadores_numeros.ip)) as porcentaje_efectividad')
        , DB::raw('sum(jugadores_numeros.boletos_otorgados) as boletos_otorgados'))
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
