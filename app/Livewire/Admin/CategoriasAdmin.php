<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Liga;
use App\Models\Deporte;
use App\Models\Categoria;

class CategoriasAdmin extends Component
{
    use WithPagination;

    public $search, $id_categoria, $categoria, $liga_id, $deporte_id; 
    public $categoria_crear, $liga_id_crear, $deporte_id_crear;
    public $lista_deportes=[], $lista_ligas=[];
    public $sort = 'categoria';
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

        $categorias = Categoria::
        where(function($q)
        {
            $q->orwhere('id', 'like', '%' . $this->search . '%');
            $q->orwhere('categoria', 'like', '%' . $this->search . '%');

            $q->orWhereHas('categoria_liga', function($query) {
                return $query->where('liga', 'like', '%' . $this->search . '%');
            });
            $q->orWhereHas('categoria_deporte', function($query) {
                return $query->where('deporte', 'like', '%' . $this->search . '%');
            });
        })
        ->orderBy($this->sort, $this->direccion)
        ->paginate($this->cant);

        return view('livewire.admin.categorias-admin', compact('categorias'));
    }

    public function loadCategorias()
    {
        $this->readyToLoad = true;
    }

    public function edit(Categoria $categoria_editar)
    {
        $this->reset(['open_edit', 'deporte_id', 'liga_id']);
        $this->resetValidation();

        $this->categoria_editar = $categoria_editar;
        $this->id_categoria = $categoria_editar['id'];
        $this->categoria = $categoria_editar['categoria'];
        $this->liga_id = $categoria_editar['liga_id'];
        $this->deporte_id = $categoria_editar['deporte_id'];

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
            'categoria' => 'required|max:30',
            'liga_id' => 'required|max:5',
            'deporte_id' => 'required|max:5',
        ]);

        $actualizar = Categoria::where('id', $this->id_categoria)
        ->update([
            'categoria' => $this->categoria,
            'liga_id' => $this->liga_id,
            'deporte_id' => $this->deporte_id,
        ]);

        $this->reset(['open_edit', 'liga_id', 'deporte_id']);
    }

    public function save()
    {
        $this->validate([
            'categoria_crear' => 'required|max:30',
            'liga_id_crear' => 'required|max:5',
            'deporte_id_crear' => 'required|max:5',
        ]);

        $cate = Categoria::create([
            'categoria' => $this->categoria_crear,
            'liga_id' => $this->liga_id_crear,
            'deporte_id' => $this->deporte_id_crear,
        ]);

        $this->reset(['open_crear', 'liga_id_crear', 'categoria_crear', 'deporte_id_crear']);

        $this->dispatch('render');
    }

    public function cerrar_ventana_update()
    {
        $this->reset(['open_edit', 'liga_id', 'deporte_id']);

        $this->resetValidation();

        $this->open_edit = false;
    }

    public function cerrar_ventana_crear()
    {
        $this->reset(['open_crear', 'liga_id_crear', 'categoria_crear', 'deporte_id_crear']);

        $this->resetValidation();

        $this->open_crear = false;
    }

    public function delete($categoriaId)
    {
        $actualizar = Categoria::where('id', $categoriaId)
        ->delete();
    }
}
