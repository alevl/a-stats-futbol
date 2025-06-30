<?php

namespace App\Livewire\Home;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Jugadore;

class Jugadores extends Component
{
    use WithPagination;

    public $search; 
    public $sort = 'nombre_jugador';
    public $direccion = 'asc';
    public $cant = 100;
    public $readyToLoad = false;

    protected $listeners = ['render', 'delete'];

    public function updatingSearch()
    { 
        $this->resetPage();
    }

    public function render()
    {
        $jugadores = Jugadore::select('jugadores.*','equipos.*', 'jugadores.id as id_jugador', 'equipos.id as id_quipo', 'equipos.nombre as nombre_equipo', 'jugadores.nombre as nombre_jugador', 'categorias.*', 'categorias.categoria as categoria')
        ->join('equipos', 'equipos.id', '=', 'jugadores.equipo_id')
        ->join('categorias', 'equipos.categoria_id', '=', 'categorias.id')
        ->where(function($q)
        {
            $q->orwhere('jugadores.id', 'like', '%' . $this->search . '%');
            $q->orwhere('jugadores.nombre', 'like', '%' . $this->search . '%');
            $q->orwhere('equipos.nombre', 'like', '%' . $this->search . '%');
            $q->orwhere('categorias.categoria', 'like', '%' . $this->search . '%');
        })
        ->orderBy($this->sort, $this->direccion)
        ->paginate($this->cant);

        return view('livewire.home.jugadores', compact('jugadores'));
    }

    public function loadEquipos()
    {
        $this->readyToLoad = true;
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
