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
        , DB::raw('sum(jugadores_numeros.average) as average')
        , DB::raw('sum(jugadores_numeros.slugging) as slugging')
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
        ->join('categorias', 'categorias.id', '=', 'jugadores_numeros.categoria_id')
        ->where('jugadores_numeros.jugador_id', $this->id_jugador)
        ->groupBy('jugadores_numeros.campeonato_id')
        ->get();

        $ultimos_tres = DB::table('jugadores_numeros')
        ->select('jugadores_numeros.*','campeonatos.nombre as campeonato', 'categorias.categoria as categoria'
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
        , DB::raw('sum(jugadores_numeros.average) as average')
        , DB::raw('sum(jugadores_numeros.slugging) as slugging')
        , DB::raw('sum(jugadores_numeros.apariciones) as apariciones')
        , DB::raw('sum(jugadores_numeros.sacrificios) as sacrificios')
        , DB::raw('sum(jugadores_numeros.golpeados) as golpeados')
        , DB::raw('sum(jugadores_numeros.vo) as vo')
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
        , DB::raw('sum(jugadores_numeros.boletos_otorgados) as boletos_otorgados'))
        ->join('campeonatos', 'campeonatos.id', '=', 'jugadores_numeros.campeonato_id')
        ->join('categorias', 'categorias.id', '=', 'jugadores_numeros.categoria_id')
        ->where('jugadores_numeros.jugador_id', $this->id_jugador)
        ->groupBy('jugadores_numeros.campeonato_id')
        ->orderBy('fecha', 'desc')
        ->take(3)
        ->get();

        $ultimos_cincos = DB::table('jugadores_numeros')
        ->select('jugadores_numeros.*','campeonatos.nombre as campeonato', 'categorias.categoria as categoria'
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
        , DB::raw('sum(jugadores_numeros.average) as average')
        , DB::raw('sum(jugadores_numeros.slugging) as slugging')
        , DB::raw('sum(jugadores_numeros.apariciones) as apariciones')
        , DB::raw('sum(jugadores_numeros.sacrificios) as sacrificios')
        , DB::raw('sum(jugadores_numeros.golpeados) as golpeados')
        , DB::raw('sum(jugadores_numeros.vo) as vo')
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
        , DB::raw('sum(jugadores_numeros.boletos_otorgados) as boletos_otorgados'))
        ->join('campeonatos', 'campeonatos.id', '=', 'jugadores_numeros.campeonato_id')
        ->join('categorias', 'categorias.id', '=', 'jugadores_numeros.categoria_id')
        ->where('jugadores_numeros.jugador_id', $this->id_jugador)
        ->groupBy('jugadores_numeros.campeonato_id')
        ->orderBy('fecha', 'desc')
        ->take(5)
        ->get();

        $juegos_totales = DB::table('jugadores_numeros')
        ->select('jugadores_numeros.*','campeonatos.nombre as campeonato','equipos.nombre as oponente', 'categorias.categoria as categoria'
        , 'jugadores_numeros.juegos as juegos'
        , 'jugadores_numeros.vb as vb'
        , 'jugadores_numeros.anotadas as anotadas'
        , 'jugadores_numeros.hit as hit'
        , 'jugadores_numeros.dobles as dobles'
        , 'jugadores_numeros.triples as triples'
        , 'jugadores_numeros.hr as hr'
        , 'jugadores_numeros.rbi as rbi'
        , 'jugadores_numeros.boletos_recibidos as boletos_recibidos'
        , 'jugadores_numeros.ponches as ponches'
        , 'jugadores_numeros.robadas as robadas'
        , 'jugadores_numeros.out_robando as out_robando'
        , 'jugadores_numeros.alcanzadas as alcanzadas'
        , 'jugadores_numeros.average as average'
        , 'jugadores_numeros.slugging as slugging'
        , 'jugadores_numeros.apariciones as apariciones'
        , 'jugadores_numeros.sacrificios as sacrificios'
        , 'jugadores_numeros.golpeados as golpeados'
        , 'jugadores_numeros.vo as vo'
        , 'jugadores_numeros.j as j'
        , 'jugadores_numeros.ganados as ganados'
        , 'jugadores_numeros.perdidos as perdidos'
        , 'jugadores_numeros.efectividad as efectividad'
        , 'jugadores_numeros.salvados as salvados'
        , 'jugadores_numeros.ip as ip'
        , 'jugadores_numeros.iniciados as iniciados'
        , 'jugadores_numeros.relevos as relevos'
        , 'jugadores_numeros.completos as completos'
        , 'jugadores_numeros.veces_bate as veces_bate'
        , 'jugadores_numeros.h2 as h2'
        , 'jugadores_numeros.h3 as h3'
        , 'jugadores_numeros.h4 as h4'
        , 'jugadores_numeros.gp as gp'
        , 'jugadores_numeros.wp as wp'
        , 'jugadores_numeros.bk as bk'
        , 'jugadores_numeros.carreras_permitidas as carreras_permitidas'
        , 'jugadores_numeros.carreras_limpias as carreras_limpias'
        , 'jugadores_numeros.ponches_propinados as ponches_propinados'
        , 'jugadores_numeros.boletos_otorgados as boletos_otorgados')
        ->join('campeonatos', 'campeonatos.id', '=', 'jugadores_numeros.campeonato_id')
        ->join('equipos', 'equipos.id', '=', 'jugadores_numeros.oponente_id')
        ->join('categorias', 'categorias.id', '=', 'jugadores_numeros.categoria_id')
        ->where('jugadores_numeros.jugador_id', $this->id_jugador)
        ->orderBy('fecha_invertida','asc')
        ->get();

        return view('livewire.home.jugadores-numeritos')->with('numeros_temporadas', $numeros_temporadas)->with('ultimos_tres', $ultimos_tres)->with('ultimos_cincos', $ultimos_cincos)->with('juegos_totales', $juegos_totales);
    }
}