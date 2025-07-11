<?php

namespace App\Livewire\Home;

use Livewire\Component;
use App\Models\Posicione;
use App\Models\Equipo;
use App\Models\Campeonato;

class Posiciones extends Component
{
    public $torneo=0, $categoria=0, $torneos=[], $categorias=[];

    public function updatedCategoria($value)
    {
        $this->torneo = null;
    }

    public function render()
    {
        $this->categorias = Campeonato::orderBy('categoria_id','asc')
        ->select('categorias.*','campeonatos.*','categorias.categoria as categoria','categorias.id as id')
        ->join('categorias', 'categorias.id', '=', 'campeonatos.categoria_id')
        ->get();

        $this->torneos = Campeonato::where('categoria_id', $this->categoria)->orderBy('fecha_inicio','desc')->get();

        $posiciones = Posicione::
        select('posiciones.*', 'equipos.*')
        ->join('equipos', 'equipos.id', '=', 'posiciones.equipo_id')
        ->where('posiciones.categoria_id', $this->categoria)
        ->where('posiciones.campeonato_id', $this->torneo)
        ->orderBy('posiciones.puntos','desc')
        ->orderBy('posiciones.ganados','desc')
        ->orderBy('posiciones.perdidos','asc')
        ->get();

        return view('livewire.home.posiciones')->with('posiciones', $posiciones);
    }
}
