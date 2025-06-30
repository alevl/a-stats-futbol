<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\Equipo;
use App\Models\Liga;
use App\Models\Categoria;
use App\Models\Campeonato;
use App\Models\Jugadore;
use App\Models\User;
use DB;

class RosterActivo extends Component
{
    public $id_equipo, $search, $id_jugador, $nombre, $nacimiento, $batea, $lanza, $numero, $equipo_id, $foto;
    public $nombre_crear, $numero_crear, $batea_crear="Derecha", $lanza_crear="Derecha", $nacimiento_crear, $equipo_id_crear, $foto_crear;
    public $datos_equipo;
    public $sort = 'nombre';
    public $direccion = 'asc';
    public $cant = 50;
    public $readyToLoad = false;
    public $open_edit = false;
    public $open_crear = false;

    protected $listeners = ['render', 'delete'];

    public function mount($id_equipo)
    {
        $this->id_equipo = $id_equipo;

        if(auth()->user()->nivel_id <> 1)
        {
            session()->flush();
            return redirect()->route('login');
        }

        $this->datos_equipo = DB::table('equipos')
        ->select('equipos.*','ligas.*','categorias.*')
        ->join('ligas', 'ligas.id', '=', 'equipos.liga_id')
        ->join('categorias', 'categorias.id', '=', 'equipos.categoria_id')
        ->where('equipos.id', $this->id_equipo)
        ->first();
    }

    public function render()
    {
        $jugadores = Jugadore::where('equipo_id', $this->id_equipo)
        ->where(function($q)
        {
            $q->orwhere('id', 'like', '%' . $this->search . '%');
            $q->orwhere('nombre', 'like', '%' . $this->search . '%');
            $q->orwhere('numero', 'like', '%' . $this->search . '%');
            $q->orwhere('nacimiento', 'like', '%' . $this->search . '%');
            $q->orwhere('batea', 'like', '%' . $this->search . '%');
            $q->orwhere('lanza', 'like', '%' . $this->search . '%');
        })
        ->orderBy($this->sort, $this->direccion)
        ->get();

        return view('livewire.admin.roster-activo', compact('jugadores'));
    }

    public function loadJugadores()
    {
        $this->readyToLoad = true;
    }

    public function edit(Jugadore $jugador_editar)
    {
        $this->reset(['open_edit', 'nombre', 'numero', 'nacimiento', 'batea', 'lanza']);
        $this->resetValidation();

        $this->jugador_editar = $jugador_editar;
        $this->id_jugador = $jugador_editar['id'];
        $this->nombre = $jugador_editar['nombre'];
        $this->numero = $jugador_editar['numero'];
        $this->nacimiento = $jugador_editar['nacimiento'];
        $this->batea = $jugador_editar['batea'];
        $this->lanza = $jugador_editar['lanza'];

        $this->open_edit = true;
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

    public function update(){
        $this->validate([
            'nombre' => 'required|max:75',
            'numero' => 'numeric|max:999',
            'nacimiento' => 'max:50',
            'batea' => 'required|max:12',
            'lanza' => 'required|max:12',
        ]);

        $actualizar = Jugadore::where('id', $this->id_jugador)
        ->update([
            'nombre' => $this->nombre,
            'numero' => $this->numero,
            'nacimiento' => $this->nacimiento,
            'batea' => $this->batea,
            'lanza' => $this->lanza,
        ]);

        $this->reset(['open_edit', 'nombre', 'numero', 'nacimiento', 'batea', 'lanza']);
    }

    public function save()
    {
        $this->validate([
            'nombre_crear' => 'required|max:75',
            'numero_crear' => 'numeric|max:999',
            'nacimiento_crear' => 'max:50',
            'batea_crear' => 'required|max:12',
            'lanza_crear' => 'required|max:12',
        ]);
        
        if($existe = Jugadore::where('nombre', $this->nombre_crear)->count())
        {
            $this->dispatch('duplicado');
        }
        else
        {
            $jug = Jugadore::create([
                'nombre' => ucwords($this->nombre_crear),
                'numero' => $this->numero_crear,
                'nacimiento' => $this->nacimiento_crear,
                'batea' => $this->batea_crear,
                'lanza' => $this->lanza_crear,
                'equipo_id' => $this->id_equipo,
            ]);

            $this->reset(['open_crear', 'nombre_crear']);

            $this->dispatch('render');
        }
    }

    public function cerrar_ventana_update()
    {
        $this->reset(['open_edit', 'nombre', 'numero', 'nacimiento', 'batea', 'lanza']);

        $this->resetValidation();

        $this->open_edit = false;
    }

    public function cerrar_ventana_crear()
    {
        $this->reset(['open_crear', 'nombre_crear', 'numero_crear', 'nacimiento_crear', 'batea_crear', 'lanza_crear']);

        $this->resetValidation();

        $this->open_crear = false;
    }

    public function delete($jugadorId)
    {
        $actualizar = Jugadore::where('id', $jugadorId)
        ->delete();
    }
}
