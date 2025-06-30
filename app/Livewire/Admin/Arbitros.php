<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Arbitro;

class Arbitros extends Component
{
    use WithPagination;

    public $search, $id_arbitro, $arbitro; 
    public $arbitro_crear;
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
        $arbitros = Arbitro::
        where(function($q)
        {
            $q->orwhere('id', 'like', '%' . $this->search . '%');
            $q->orwhere('nombre', 'like', '%' . $this->search . '%');
        })
        ->orderBy($this->sort, $this->direccion)
        ->paginate($this->cant);

        return view('livewire.admin.arbitros', compact('arbitros'));
    }

    public function loadArbitros()
    {
        $this->readyToLoad = true;
    }

    public function edit(Arbitro $arbitro_editar)
    {
        $this->reset(['open_edit', 'arbitro']);
        $this->resetValidation();

        $this->id_arbitro = $arbitro_editar['id'];
        $this->arbitro = $arbitro_editar['nombre'];

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
            'arbitro' => 'required|max:50',
        ]);

        $actualizar = Arbitro::where('id', $this->id_arbitro)
        ->update([
            'nombre' => $this->arbitro,
        ]);

        $this->reset(['open_edit', 'arbitro']);
        $this->dispatch('alert');
    }

    public function save()
    {
        $this->validate([
            'arbitro_crear' => 'required|max:50',
        ]);

        $lig = Arbitro::create([
            'nombre' => $this->arbitro_crear,
        ]);

        $this->reset(['open_crear', 'arbitro_crear']);

        $this->dispatch('render');
        $this->dispatch('alert');
    }

    public function cerrar_ventana_update()
    {
        $this->reset(['open_edit', 'arbitro']);

        $this->resetValidation();

        $this->open_edit = false;
    }

    public function cerrar_ventana_crear()
    {
        $this->reset(['open_crear', 'arbitro_crear']);

        $this->resetValidation();

        $this->open_crear = false;
    }

    public function delete($arbitroId)
    {
        $actualizar = Arbitro::where('id', $arbitroId)
        ->delete();
    }
}
