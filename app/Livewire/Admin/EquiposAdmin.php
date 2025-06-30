<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Liga;
use App\Models\Deporte;
use App\Models\Categoria;
use App\Models\Equipo;
use App\Models\Campeonato;
use App\Models\Posicione;

class EquiposAdmin extends Component
{
    use WithPagination;

    public $search, $id_equipo, $nombre, $abreviacion, $equipo_id, $liga_id, $deporte_id, $categoria_id, $campeonato_id; 
    public $nombre_crear, $abreviacion_crear, $categoria_id_crear, $liga_id_crear, $deporte_id_crear, $campeonato_id_crear;
    public $lista_deportes=[], $lista_ligas=[], $lista_categorias=[], $lista_torneos=[];
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
        $this->lista_deportes = Deporte::orderBy('deporte','asc')->get();
        $this->lista_ligas = Liga::orderBy('liga','asc')->get();
        $this->lista_categorias = Categoria::orderBy('categoria','asc')->get();
        $this->lista_torneos = Campeonato::orderBy('nombre','asc')->get();

        $equipos = Equipo::
        where(function($q)
        {
            $q->orwhere('id', 'like', '%' . $this->search . '%');
            $q->orwhere('nombre', 'like', '%' . $this->search . '%');
            $q->orwhere('abreviacion', 'like', '%' . $this->search . '%');

            $q->orWhereHas('equipo_deporte', function($query) {
                return $query->where('deporte', 'like', '%' . $this->search . '%');
            });
            $q->orWhereHas('equipo_liga', function($query) {
                return $query->where('liga', 'like', '%' . $this->search . '%');
            });
            $q->orWhereHas('equipo_categoria', function($query) {
                return $query->where('categoria', 'like', '%' . $this->search . '%');
            });
            $q->orWhereHas('equipo_torneo', function($query) {
                return $query->where('nombre', 'like', '%' . $this->search . '%');
            });
        })
        ->orderBy($this->sort, $this->direccion)
        ->paginate($this->cant);

        return view('livewire.admin.equipos-admin', compact('equipos'));
    }

    public function loadEquipos()
    {
        $this->readyToLoad = true;
    }

    public function edit(Equipo $equipo_editar)
    {
        $this->reset(['open_edit', 'nombre', 'abreviacion', 'deporte_id', 'liga_id', 'categoria_id']);
        $this->resetValidation();

        $this->equipo_editar = $equipo_editar;
        $this->id_equipo = $equipo_editar['id'];
        $this->nombre = $equipo_editar['nombre'];
        $this->abreviacion = $equipo_editar['abreviacion'];
        $this->liga_id = $equipo_editar['liga_id'];
        $this->deporte_id = $equipo_editar['deporte_id'];
        $this->categoria_id = $equipo_editar['categoria_id'];
        $this->campeonato_id = $equipo_editar['campeonato_id'];

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
            'abreviacion' => 'required|max:5',
            'liga_id' => 'required|max:5',
            'deporte_id' => 'required|max:5',
            'categoria_id' => 'required|max:5',
            'campeonato_id' => 'required|max:5',
        ]);

        $actualizar = Equipo::where('id', $this->id_equipo)
        ->update([
            'nombre' => $this->nombre,
            'abreviacion' => $this->abreviacion,
            'liga_id' => $this->liga_id,
            'deporte_id' => $this->deporte_id,
            'categoria_id' => $this->categoria_id,
            'campeonato_id' => $this->campeonato_id,
        ]);

        $this->reset(['open_edit', 'nombre', 'abreviacion', 'liga_id', 'deporte_id', 'categoria_id', 'campeonato_id']);
    }

    public function save()
    {
        $this->validate([
            'nombre_crear' => 'required|max:100',
            'abreviacion_crear' => 'required|max:5',
            'liga_id_crear' => 'required|max:5',
            'deporte_id_crear' => 'required|max:5',
            'categoria_id_crear' => 'required|max:5',
            'campeonato_id_crear' => 'required|max:5',
        ]);

        $equip = Equipo::create([
            'nombre' => $this->nombre_crear,
            'abreviacion' => $this->abreviacion_crear,
            'liga_id' => $this->liga_id_crear,
            'deporte_id' => $this->deporte_id_crear,
            'categoria_id' => $this->categoria_id_crear,
            'campeonato_id' => $this->campeonato_id_crear,
        ]);

        $this->reset(['open_crear', 'nombre_crear', 'abreviacion_crear', 'categoria_id_crear', 'liga_id_crear', 'deporte_id_crear', 'campeonato_id_crear']);

        $this->dispatch('render');
    }

    public function cerrar_ventana_update()
    {
        $this->reset(['open_edit', 'nombre', 'abreviacion', 'liga_id', 'deporte_id', 'categoria_id', 'campeonato_id']);

        $this->resetValidation();

        $this->open_edit = false;
    }

    public function cerrar_ventana_crear()
    {
        $this->reset(['open_crear', 'nombre_crear', 'abreviacion_crear', 'categoria_id_crear', 'liga_id_crear', 'deporte_id_crear', 'campeonato_id_crear']);

        $this->resetValidation();

        $this->open_crear = false;
    }

    public function delete($equipoId)
    {
        $actualizar = Equipo::where('id', $equipoId)
        ->delete();
    }
}
