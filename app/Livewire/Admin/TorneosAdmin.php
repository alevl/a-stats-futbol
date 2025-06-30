<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Campeonato;
use App\Models\Liga;
use App\Models\Categoria;
use App\Models\EstatusTorneo;
use App\Models\Equipo;
use App\Models\Calendario;
use DB;

use App\Models\JugadoresNumero;
use App\Models\JugadoresDefensiva;

class TorneosAdmin extends Component
{
    use WithPagination;

    public $search, $id_torneo, $nombre, $liga_id, $categoria_id, $campeon, $fecha_inicio, $estatus_id;
    public $nombre_crear, $liga_id_crear, $categoria_id_crear, $fecha_inicio_crear, $estatus_id_crear;
    public $lista_equipos=[], $lista_ligas=[], $lista_categorias=[], $lista_estatus=[];
    public $sort = 'nombre';
    public $direccion = 'asc';
    public $cant = 50;
    public $readyToLoad = false;
    public $open_edit = false;
    public $open_crear = false;

    protected $listeners = ['render', 'delete'];

    public function updatingSearch()
    { 
        $this->resetPage();
    }

    public function mount()
    {
        if(auth()->user()->nivel_id <> 1)
        {
            session()->flush();
            return redirect()->route('login');
        }
    }

    public function render()
    {
        $this->lista_equipos = Equipo::orderBy('nombre','asc')->get();
        $this->lista_ligas = Liga::orderBy('liga','asc')->get();
        $this->lista_estatus = EstatusTorneo::orderBy('estatus','asc')->get();
        $this->lista_categorias = Categoria::orderBy('categoria','asc')->get();

        $torneos = Campeonato::
        where(function($q)
        {
            $q->orwhere('id', 'like', '%' . $this->search . '%');
            $q->orwhere('nombre', 'like', '%' . $this->search . '%');
            $q->orwhere('campeon', 'like', '%' . $this->search . '%');
            $q->orwhere('fecha_inicio', 'like', '%' . $this->search . '%');

            $q->orWhereHas('torneo_liga', function($query) {
                return $query->where('liga', 'like', '%' . $this->search . '%');
            });
            $q->orWhereHas('torneo_categoria', function($query) {
                return $query->where('categoria', 'like', '%' . $this->search . '%');
            });
            $q->orWhereHas('torneo_estatus', function($query) {
                return $query->where('estatus', 'like', '%' . $this->search . '%');
            });
        })
        ->orderBy($this->sort, $this->direccion)
        ->paginate($this->cant);

        $juegos = Calendario::select("campeonato_id", DB::raw("COUNT(*) as total_juegos"))
        ->groupBy(DB::raw("campeonato_id"))
        ->get();

        return view('livewire.admin.torneos-admin', compact('torneos'))->with('juegos', $juegos);
    }

    public function loadCampeonatos()
    {
        $this->readyToLoad = true;
    }

    public function edit(Campeonato $torneo_editar)
    {
        $this->reset(['open_edit', 'nombre', 'liga_id', 'campeon', 'categoria_id', 'estatus_id', 'fecha_inicio']);
        $this->resetValidation();

        $this->torneo_editar = $torneo_editar;
        $this->id_torneo = $torneo_editar['id'];
        $this->nombre = $torneo_editar['nombre'];
        $this->fecha_inicio = $torneo_editar['fecha_inicio'];
        $this->campeon = $torneo_editar['campeon'];
        $this->liga_id = $torneo_editar['liga_id'];
        $this->categoria_id = $torneo_editar['categoria_id'];
        $this->estatus_id = $torneo_editar['estatus_id'];

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
            'nombre' => 'required|max:100',
            'fecha_inicio' => 'required|max:10|date_format:d/m/Y',
            'campeon' => 'max:100',
            'liga_id' => 'required|max:5',
            'estatus_id' => 'required|max:5',
            'categoria_id' => 'required|max:5',
        ]);

        $actualizar = Campeonato::where('id', $this->id_torneo)
        ->update([
            'nombre' => $this->nombre,
            'fecha_inicio' => $this->fecha_inicio,
            'campeon' => $this->campeon,
            'liga_id' => $this->liga_id,
            'estatus_id' => $this->estatus_id,
            'categoria_id' => $this->categoria_id,
        ]);

        $this->reset(['open_edit', 'nombre', 'liga_id', 'campeon', 'categoria_id', 'estatus_id', 'fecha_inicio']);
    }

    public function save()
    {
        $this->validate([
            'nombre_crear' => 'required|max:100',
            'fecha_inicio_crear' => 'required|max:10|date_format:d/m/Y',
            'liga_id_crear' => 'required|max:5',
            'estatus_id_crear' => 'required|max:5',
            'categoria_id_crear' => 'required|max:5',
        ]);

        $tor = Campeonato::create([
            'nombre' => $this->nombre_crear,
            'fecha_inicio' => $this->fecha_inicio_crear,
            'liga_id' => $this->liga_id_crear,
            'estatus_id' => $this->estatus_id_crear,
            'categoria_id' => $this->categoria_id_crear,
        ]);

        $this->reset(['open_crear', 'nombre_crear', 'liga_id_crear', 'categoria_id_crear', 'estatus_id_crear', 'fecha_inicio_crear']);

        $this->dispatch('render');
    }

    public function cerrar_ventana_update()
    {
        $this->reset(['open_edit', 'nombre', 'liga_id', 'campeon', 'categoria_id', 'estatus_id', 'fecha_inicio']);

        $this->resetValidation();

        $this->open_edit = false;
    }

    public function cerrar_ventana_crear()
    {
        $this->reset(['open_crear', 'nombre_crear', 'liga_id_crear', 'categoria_id_crear', 'estatus_id_crear', 'fecha_inicio_crear']);

        $this->resetValidation();

        $this->open_crear = false;
    }

    public function delete($torneoId)
    {
        $actualizar = Campeonato::where('id', $torneoId)
        ->delete();
    }
}
