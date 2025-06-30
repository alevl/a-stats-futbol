<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Noticia;
use App\Models\EstatusTorneo;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class NoticiasAdmin extends Component
{
    use WithPagination;
    use WithFileUploads;

    public $search, $id_noticia, $titulo, $desarrollo, $estatus_id; 
    public $titulo_crear, $estatus_id_crear, $desarrollo_crear;
    public $logo_crear, $logo, $e_imagen, $identificador, $imagen_noticia;

    public $lista_estatus=[];
    public $sort = 'titulo';
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
        $this->identificador = rand();

        if(auth()->user()->nivel_id <> 1)
        {
            session()->flush();
            return redirect()->route('login');
        }
    }

    public function render()
    {
        $this->lista_estatus = EstatusTorneo::orderBy('estatus','asc')->get();

        $noticias = Noticia::
        where(function($q)
        {
            $q->orwhere('titulo', 'like', '%' . $this->search . '%');
            $q->orwhere('desarrollo', 'like', '%' . $this->search . '%');

            $q->orWhereHas('noticia_estatus', function($query) {
                return $query->where('estatus', 'like', '%' . $this->search . '%');
            });
        })
        ->orderBy($this->sort, $this->direccion)
        ->paginate($this->cant);

        return view('livewire.admin.noticias-admin', compact('noticias'));
    }

    public function loadLigas()
    {
        $this->readyToLoad = true;
    }

    public function edit(Noticia $noticia_editar)
    {
        $this->id_noticia = $noticia_editar['id'];
        $this->titulo = $noticia_editar['titulo'];
        $this->desarrollo = $noticia_editar['desarrollo'];
        $this->estatus_id = $noticia_editar['estatus_id'];
        $this->imagen_noticia = $noticia_editar['imagen'];

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

        if($this->logo == '')
        {
            $this->validate([
                'titulo' => 'required|max:100',
                'desarrollo' => 'required|max:3000',
                'estatus_id' => 'required|max:5',
            ]);
        }
        else
        {
            $this->validate([
                'titulo' => 'required|max:100',
                'desarrollo' => 'required|max:3000',
                'estatus_id' => 'required|max:5',
                'logo' => 'mimes:jpg,jpeg,png,bmp,gif,svg,webp|max:2048',
            ]);
        }

        if($this->logo <> '')
        {
            Storage::delete([$this->imagen_noticia]);

            $nombre = Str::random(17).$this->logo->getClientOriginalName();
            $manager = new ImageManager(new Driver());
            $image = $manager->read($this->logo);
            $image->resize(1920, 1080);
            $image->toPng()->save('storage/noticias/'.$nombre);

            $nombre_insertar = 'noticias/'.$nombre;

            $actualizar = Noticia::where('id', $this->id_noticia)
            ->update([
                'titulo' => $this->titulo,
                'desarrollo' => $this->desarrollo,
                'estatus_id' => $this->estatus_id,
                'imagen' => $nombre_insertar,
            ]);
        }
        else
        {
            $actualizar = Noticia::where('id', $this->id_noticia)
            ->update([
                'titulo' => $this->titulo,
                'desarrollo' => $this->desarrollo,
                'estatus_id' => $this->estatus_id,
            ]);
        }

        $this->identificador = rand();
        $this->reset(['open_edit', 'logo', 'titulo', 'desarrollo', 'estatus_id']);
        $this->dispatch('alert');
    }

    public function save()
    {
        $this->validate([
            'logo_crear' => 'mimes:jpg,jpeg,png,bmp,gif,svg,webp|max:2048',
            'titulo_crear' => 'required|max:100',
            'desarrollo_crear' => 'required|max:3000',
            'estatus_id_crear' => 'required|max:5',
        ]);

        if($this->logo_crear <> '')
        {
            $nombre = Str::random(17).$this->logo_crear->getClientOriginalName();
            $manager = new ImageManager(new Driver());
            $image = $manager->read($this->logo_crear);
            $image->resize(1920, 1080);
            $image->toPng()->save('storage/noticias/'.$nombre);
            $nombre_insertar = 'noticias/'.$nombre;
        }
        else
        {
            $nombre_insertar = "";
        }

        $not = Noticia::create([
            'imagen' => $nombre_insertar,
            'titulo' => $this->titulo_crear,
            'desarrollo' => $this->desarrollo_crear,
            'estatus_id' => $this->estatus_id_crear,
        ]);

        $this->reset(['open_crear', 'logo_crear','titulo_crear', 'desarrollo_crear', 'estatus_id_crear']);

        $this->identificador = rand();
        $this->dispatch('render');
        $this->dispatch('alert');
    }

    public function cerrar_ventana_update()
    {
        $this->reset(['open_edit', 'logo', 'titulo', 'desarrollo', 'estatus_id']);

        $this->resetValidation();

        $this->open_edit = false;
    }

    public function cerrar_ventana_crear()
    {
        $this->reset(['open_crear', 'logo_crear', 'titulo_crear', 'desarrollo_crear', 'estatus_id_crear']);

        $this->resetValidation();

        $this->open_crear = false;
    }

    public function delete($noticiaId)
    {
        $eliminar = Noticia::where('id', $noticiaId)
        ->delete();
    }
}
