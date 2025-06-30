<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Equipo;
use App\Models\Liga;
use App\Models\Categoria;
use App\Models\Campeonato;
use App\Models\Jugadore;
use App\Models\JugadoresNumero;
use App\Models\JugadoresDefensiva;

class JugadoresAdmin extends Component
{
    use WithPagination;

    public $search, $id_jugador, $nombre, $dni, $equipo_id, $liga_id, $campeonato_id, $categoria_id, $foto; 
    public $nombre_crear, $dni_crear, $equipo_id_crear, $liga_id_crear, $campeonato_id_crear, $categoria_id_crear, $foto_crear;
    public $lista_equipos=[], $lista_ligas=[], $lista_campeonatos=[], $lista_categorias=[], $lista_jugadores=[], $jugador_origen, $jugador_destino;
    public $sort = 'nombre_jugador';
    public $direccion = 'asc';
    public $cant = 200;
    public $readyToLoad = false;
    public $open_edit = false;
    public $open_crear = false;
    public $open_consolidar = false;

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
        $this->lista_campeonatos = Campeonato::orderBy('nombre','asc')->get();
        $this->lista_categorias = Categoria::orderBy('categoria','asc')->get();
        $this->lista_jugadores = Jugadore::orderBy('nombre','asc')->get();

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

        return view('livewire.admin.jugadores-admin', compact('jugadores'));
    }

    public function consolidar()
    {
        $this->validate([
            'jugador_origen' => 'required|numeric',
            'jugador_destino' => 'required|numeric',
        ]);

        $origen = JugadoresNumero::where('jugador_id', $this->jugador_origen)->get();
        foreach($origen as $orig)
        {
            $destino = JugadoresNumero::create([
                'juego_id' => $orig->juego_id,
                'fecha' => $orig->fecha,
                'jugador_id' => $this->jugador_destino,
                'oponente_id' => $orig->oponente_id,
                'liga_id' => $orig->liga_id,
                'campeonato_id' => $orig->campeonato_id,
                'categoria_id' => $orig->categoria_id,
                'orden_bat' => $orig->orden_bat,
                'posicion' => $orig->posicion,
                'juegos' => $orig->juegos,
                'vb' => $orig->vb,
                'anotadas' => $orig->anotadas,
                'hit' => $orig->hit,
                'dobles' => $orig->dobles,
                'triples' => $orig->triples,
                'hr' => $orig->hr,
                'rbi' => $orig->rbi,
                'boletos_recibidos' => $orig->boletos_recibidos,
                'ponches' => $orig->ponches,
                'robadas' => $orig->robadas,
                'out_robando' => $orig->out_robando,
                'alcanzadas' => $orig->alcanzadas,
                'average' => $orig->average,
                'slugging' => $orig->slugging,
                'apariciones' => $orig->apariciones,
                'sacrificios' => $orig->sacrificios,
                'golpeados' => $orig->golpeados,
                'vo' => $orig->vo,
                'orden_pit' => $orig->orden_pit,
                'j' => $orig->j,
                'ganados' => $orig->ganados,
                'perdidos' => $orig->perdidos,
                'salvados' => $orig->salvados,
                'efectividad' => $orig->efectividad,
                'blanqueos' => $orig->blanqueos,
                'ip' => $orig->ip,
                'carreras_permitidas' => $orig->carreras_permitidas,
                'carreras_limpias' => $orig->carreras_limpias,
                'ponches_propinados' => $orig->ponches_propinados,
                'boletos_otorgados' => $orig->boletos_otorgados,
                'hp' => $orig->hp,
                'pitcheos' => $orig->pitcheos,
                'iniciados' => $orig->iniciados,
                'relevos' => $orig->relevos,
                'completos' => $orig->completos,
                'veces_bate' => $orig->veces_bate,
                'h2' => $orig->h2,
                'h3' => $orig->h3,
                'h4' => $orig->h4,
                'gp' => $orig->gp,
                'wp' => $orig->wp,
                'bk' => $orig->bk,
                'observacion' => 'Juego Consolidado',
                'recopilador_id' => $orig->recopilador_id,
            ]);

            $actualizar = JugadoresNumero::where('id', $orig->id)->update([
                'observacion' => 'ELIMINAR CONSOLIDADO',
            ]);
        }

        $origen = JugadoresDefensiva::where('jugador_id', $this->jugador_origen)->get();
        foreach($origen as $orig)
        {
            $destino = JugadoresDefensiva::create([
                'juego_id' => $orig->juego_id,
                'fecha' => $orig->fecha,
                'jugador_id' => $this->jugador_destino,
                'oponente_id' => $orig->oponente_id,
                'liga_id' => $orig->liga_id,
                'campeonato_id' => $orig->campeonato_id,
                'categoria_id' => $orig->categoria_id,
                'juegos' => $orig->juegos,
                'posicion' => $orig->posicion,
                'innings' => $orig->innings,
                'outs' => $orig->outs,
                'asistencias' => $orig->asistencias,
                'errores' => $orig->errores,
                'porcentaje_fildeo' => $orig->porcentaje_fildeo,
                'observacion' => 'Juego Consolidado',
                'recopilador_id' => $orig->recopilador_id,
            ]);

            $actualizar = JugadoresNumero::where('id', $orig->id)->update([
                'observacion' => 'ELIMINAR CONSOLIDADO',
            ]);
        }

        $this->reset(['open_consolidar', 'jugador_origen', 'jugador_destino']);
        $this->dispatch('alert');
    }

    public function loadJugadores()
    {
        $this->readyToLoad = true;
    }

    public function edit(Jugadore $jugador_editar)
    {
        $this->reset(['open_edit', 'nombre', 'dni', 'equipo_id', 'liga_id', 'campeonato_id', 'categoria_id']);
        $this->resetValidation();

        $this->jugador_editar = $jugador_editar;
        $this->id_jugador = $jugador_editar['id'];
        $this->nombre = $jugador_editar['nombre'];
        $this->dni = $jugador_editar['dni'];
        $this->equipo_id = $jugador_editar['equipo_id'];
        $this->campeonato_id = $jugador_editar['campeonato_id'];
        $this->categoria_id = $jugador_editar['categoria_id'];

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
            'dni' => 'max:999999999',
            'equipo_id' => 'required|max:5',
            'liga_id' => 'required|max:5',
            'campeonato_id' => 'required|max:5',
            'categoria_id' => 'required|max:5',
        ]);

        $actualizar = Jugadore::where('id', $this->id_jugador)
        ->update([
            'nombre' => $this->nombre,
            'dni' => $this->dni,
            'equipo_id' => $this->equipo_id,
            'liga_id' => $this->liga_id,
            'campeonato_id' => $this->campeonato_id,
            'categoria_id' => $this->categoria_id,
        ]);

        $this->reset(['open_edit', 'nombre', 'dni', 'equipo_id', 'liga_id', 'campeonato_id', 'categoria_id']);
        $this->dispatch('alert');
    }

    public function save()
    {
        $this->validate([
            'nombre_crear' => 'required|max:75',
            'dni_crear' => 'max:999999999',
            'equipo_id_crear' => 'required|max:5',
            'liga_id_crear' => 'required|max:5',
            'campeonato_id_crear' => 'required|max:5',
            'categoria_id_crear' => 'required|max:5',
        ]);

        $jugador = Jugadore::create([
            'nombre' => $this->nombre_crear,
            'dni' => $this->dni_crear,
            'equipo_id' => $this->equipo_id_crear,
            'liga_id' => $this->liga_id_crear,
            'campeonato_id' => $this->campeonato_id_crear,
            'categoria_id' => $this->categoria_id_crear,
        ]);

        $this->reset(['open_crear', 'nombre_crear', 'dni_crear', 'equipo_id_crear', 'liga_id_crear', 'categoria_id_crear']);

        $this->dispatch('render');
        $this->dispatch('alert');
    }

    public function cerrar_ventana_update()
    {
        $this->reset(['open_edit', 'nombre', 'dni', 'equipo_id', 'liga_id', 'campeonato_id', 'categoria_id']);

        $this->resetValidation();

        $this->open_edit = false;
    }

    public function cerrar_ventana_crear()
    {
        $this->reset(['open_crear', 'nombre_crear', 'dni_crear', 'equipo_id_crear', 'liga_id_crear', 'categoria_id_crear']);

        $this->resetValidation();

        $this->open_crear = false;
    }

    public function delete($jugadorId)
    {
        $actualizar = Jugadore::where('id', $jugadorId)
        ->delete();
    }
}
