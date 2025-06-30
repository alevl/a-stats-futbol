<?php

namespace App\Livewire\Home;

use Livewire\Component;
use App\Models\Calendario;
use App\Models\Campeonato;

class Resultados extends Component
{
    public $torneo=0, $categoria=0, $torneos=[], $categorias=[];

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

        $this->torneos = Campeonato::where('categoria_id', $this->categoria)->orderBy('fecha_inicio','desc')->get();

        $juegos = Calendario::where('categoria_id', $this->categoria)->where('campeonato_id', $this->torneo)->orderBy('fecha_invertida','desc')->get();

        return view('livewire.home.resultados', compact('juegos'));
    }
}
