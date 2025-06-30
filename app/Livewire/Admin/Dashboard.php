<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\Anotadore;
use App\Models\Jugadore;
use App\Models\Equipo;
use App\Models\Calendario;
use App\Models\Campeonato;
use App\Models\Categoria;
use DB;

class Dashboard extends Component
{
    public $total_anotadores, $total_jugadores, $total_equipos, $total_categorias, $total_torneos, $total_juegos, $total_deuda, $total_cobrados;

    public function render()
    {
        $lista_anotadores = Anotadore::orderBy('nombre', 'asc')->get();

        $juegos_anotadores = DB::table('calendarios')
        ->select('calendarios.*', 'anotadores.*', 'anotadores.nombre as anotador'
        , DB::raw('count(calendarios.id) as juegos'))
        ->join('anotadores', 'anotadores.id', '=', 'calendarios.anotador_id')
        ->groupBy('calendarios.anotador_id')
        ->orderBy('juegos','desc')
        ->get();

        $juegos_deudas = DB::table('calendarios')
        ->select('calendarios.*', 'anotadores.*', 'anotadores.nombre as anotador'
        , DB::raw('count(calendarios.id) as deuda'))
        ->join('anotadores', 'anotadores.id', '=', 'calendarios.anotador_id')
        ->where('facturado_id', 2)
        ->orWhere('facturado_id', '')
        ->orWhere('facturado_id', null)
        ->groupBy('calendarios.anotador_id')
        ->orderBy('deuda','desc')
        ->get();

        $desglose = DB::table('calendarios')
        ->select('calendarios.*', 'anotadores.*', 'anotadores.nombre as anotador', 'categorias.categoria as categoria')
        ->join('anotadores', 'anotadores.id', '=', 'calendarios.anotador_id')
        ->join('categorias', 'categorias.id', '=', 'calendarios.categoria_id')
        ->where('facturado_id', 2)
        ->orWhere('facturado_id', '')
        ->orWhere('facturado_id', null)
        ->orderBy('anotador','asc')
        ->orderBy('numero_juego','asc')
        ->get();

        $this->total_anotadores = Anotadore::count();
        $this->total_jugadores = Jugadore::count();
        $this->total_categorias = Categoria::count();
        $this->total_torneos = Campeonato::where('estatus_id',1)->count();
        $this->total_equipos = Equipo::count();
        $this->total_juegos = Calendario::count();
        $this->total_deuda = Calendario::where('facturado_id','<>', 1)->orWhere('facturado_id', '')->orWhere('facturado_id', null)->count();
        $this->total_cobrados = Calendario::where('facturado_id', 1)->count();

        return view('livewire.admin.dashboard', compact('lista_anotadores'))->with('juegos_anotadores', $juegos_anotadores)->with('juegos_deudas', $juegos_deudas)->with('desglose', $desglose);
    }
}
