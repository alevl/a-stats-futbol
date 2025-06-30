<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Anotadore;

class Anotadores extends Component
{
    use WithPagination;

    public $search, $id_anotador, $anotador; 
    public $anotador_crear;
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
        $anotadores = Anotadore::
        where(function($q)
        {
            $q->orwhere('id', 'like', '%' . $this->search . '%');
            $q->orwhere('nombre', 'like', '%' . $this->search . '%');
        })
        ->orderBy($this->sort, $this->direccion)
        ->paginate($this->cant);

        return view('livewire.admin.anotadores', compact('anotadores'));
    }

    public function loadAnotadores()
    {
        $this->readyToLoad = true;
    }

    public function edit(Anotadore $anotador_editar)
    {
        $this->reset(['open_edit', 'anotador']);
        $this->resetValidation();

        $this->id_anotador = $anotador_editar['id'];
        $this->anotador = $anotador_editar['nombre'];

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
            'anotador' => 'required|max:50',
        ]);

        $actualizar = Anotadore::where('id', $this->id_anotador)
        ->update([
            'nombre' => $this->anotador,
        ]);

        $this->reset(['open_edit', 'anotador']);
        $this->dispatch('alert');
    }

    public function save()
    {
        $this->validate([
            'anotador_crear' => 'required|max:50',
        ]);

        $lig = Anotadore::create([
            'nombre' => $this->anotador_crear,
        ]);

        $this->reset(['open_crear', 'anotador_crear']);

        $this->dispatch('render');
        $this->dispatch('alert');
    }

    public function cerrar_ventana_update()
    {
        $this->reset(['open_edit', 'anotador']);

        $this->resetValidation();

        $this->open_edit = false;
    }

    public function cerrar_ventana_crear()
    {
        $this->reset(['open_crear', 'anotador_crear']);

        $this->resetValidation();

        $this->open_crear = false;
    }

    public function delete($anotadorId)
    {
        $actualizar = Anotadore::where('id', $anotadorId)
        ->delete();
    }
}
