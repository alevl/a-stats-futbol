<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Estadio;

class Estadios extends Component
{
    use WithPagination;

    public $search, $id_estadio, $estadio; 
    public $estadio_crear;
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
        $estadios = Estadio::
        where(function($q)
        {
            $q->orwhere('id', 'like', '%' . $this->search . '%');
            $q->orwhere('nombre', 'like', '%' . $this->search . '%');
        })
        ->orderBy($this->sort, $this->direccion)
        ->paginate($this->cant);

        return view('livewire.admin.estadios', compact('estadios'));
    }

    public function loadEstadios()
    {
        $this->readyToLoad = true;
    }

    public function edit(Estadio $estadio_editar)
    {
        $this->reset(['open_edit', 'estadio']);
        $this->resetValidation();

        $this->id_estadio = $estadio_editar['id'];
        $this->estadio = $estadio_editar['nombre'];

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

    public function update()
    {
        $this->validate([
            'estadio' => 'required|max:100',
        ]);

        $actualizar = Estadio::where('id', $this->id_estadio)
        ->update([
            'nombre' => $this->estadio,
        ]);

        $this->reset(['open_edit', 'estadio']);
        $this->dispatch('alert');
    }

    public function save()
    {
        $this->validate([
            'estadio_crear' => 'required|max:100',
        ]);

        $lig = Estadio::create([
            'nombre' => $this->estadio_crear,
        ]);

        $this->reset(['open_crear', 'estadio_crear']);

        $this->dispatch('render');
        $this->dispatch('alert');
    }

    public function cerrar_ventana_update()
    {
        $this->reset(['open_edit', 'estadio']);

        $this->resetValidation();

        $this->open_edit = false;
    }

    public function cerrar_ventana_crear()
    {
        $this->reset(['open_crear', 'estadio_crear']);

        $this->resetValidation();

        $this->open_crear = false;
    }

    public function delete($estadioId)
    {
        $actualizar = Estadio::where('id', $estadioId)
        ->delete();
    }
}
