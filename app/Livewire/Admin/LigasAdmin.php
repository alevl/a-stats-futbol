<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Liga;
use App\Models\Deporte;

class LigasAdmin extends Component
{
    use WithPagination;

    public $search, $id_liga, $liga, $ubicacion, $deporte_id; 
    public $liga_crear, $deporte_id_crear, $ubicacion_crear;
    public $lista_deportes=[];
    public $sort = 'liga';
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

        $ligas = Liga::
        where(function($q)
        {
            $q->orwhere('id', 'like', '%' . $this->search . '%');
            $q->orwhere('liga', 'like', '%' . $this->search . '%');
            $q->orwhere('Ubicacion', 'like', '%' . $this->search . '%');

            $q->orWhereHas('liga_deporte', function($query) {
                return $query->where('deporte', 'like', '%' . $this->search . '%');
            });
        })
        ->orderBy($this->sort, $this->direccion)
        ->paginate($this->cant);

        return view('livewire.admin.ligas-admin', compact('ligas'));
    }

    public function loadLigas()
    {
        $this->readyToLoad = true;
    }

    public function edit(Liga $liga_editar)
    {
        $this->reset(['open_edit', 'deporte_id', 'ubicacion', 'liga']);
        $this->resetValidation();

        $this->liga_editar = $liga_editar;
        $this->id_liga = $liga_editar['id'];
        $this->liga = $liga_editar['liga'];
        $this->ubicacion = $liga_editar['ubicacion'];
        $this->deporte_id = $liga_editar['deporte_id'];

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
            'liga' => 'required|max:30',
            'ubicacion' => 'required|max:30',
            'deporte_id' => 'required|max:5',
        ]);

        $actualizar = Liga::where('id', $this->id_liga)
        ->update([
            'liga' => $this->liga,
            'ubicacion' => $this->ubicacion,
            'deporte_id' => $this->deporte_id,
        ]);

        $this->reset(['open_edit', 'liga', 'ubicacion', 'deporte_id']);
        $this->dispatch('alert');
    }

    public function save()
    {
        $this->validate([
            'liga_crear' => 'required|max:30',
            'ubicacion_crear' => 'required|max:30',
            'deporte_id_crear' => 'required|max:5',
        ]);

        $lig = Liga::create([
            'liga' => $this->liga_crear,
            'ubicacion' => $this->ubicacion_crear,
            'deporte_id' => $this->deporte_id_crear,
        ]);

        $this->reset(['open_crear', 'liga_crear', 'ubicacion_crear', 'deporte_id_crear']);

        $this->dispatch('render');
        $this->dispatch('alert');
    }

    public function cerrar_ventana_update()
    {
        $this->reset(['open_edit', 'liga', 'ubicacion', 'deporte_id']);

        $this->resetValidation();

        $this->open_edit = false;
    }

    public function cerrar_ventana_crear()
    {
        $this->reset(['open_crear', 'liga_crear', 'ubicacion_crear', 'deporte_id_crear']);

        $this->resetValidation();

        $this->open_crear = false;
    }

    public function delete($ligaId)
    {
        $actualizar = Liga::where('id', $ligaId)
        ->delete();
    }
}
